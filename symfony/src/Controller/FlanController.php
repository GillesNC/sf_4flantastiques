<?php

namespace App\Controller;

use App\Entity\Flan;
use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Repository\FlanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/flan')]
final class FlanController extends AbstractController
{
    #[Route('/', name: 'flan')]
    public function index(FlanRepository $flanRepository): Response
    {
        $flan = $flanRepository->findAll();

        return $this->render('flan/index.html.twig', [
            'flans' => $flan
        ]);
    }

    #[Route('/{id}', name: 'flan_detail', methods: ['GET', 'POST'])]
    public function detailFlan(Flan $flan, Request $request, EntityManagerInterface $entityManager): Response
    {
        $spot = $flan->getSpot();
        $documents = $flan->getDocuments();
        $reviews = $flan->getReviews();

        $formReview = $this->createForm(ReviewFormType::class);
        $formReview->handleRequest($request);

        if ($formReview->isSubmitted() && $formReview->isValid()) {
            $review = $formReview->getData();
            $review->setFlan($flan);
            $review->setUser($this->getUser());
            $review->calculateGlobalRating();

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('flan_detail', ['id' => $flan->getId()]);
        }

        return $this->render('flan/detailFlan.html.twig', [
            'flan' => $flan,
            'spot' => $spot,
            'documents' => $documents,
            'reviews' => $reviews,
            'formReview' => $formReview
        ]);
    }

    #[Route('/delete/{id}', name: 'review_delete', methods: ['POST'])]
    public function delete(Review $review, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($review->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à supprimer cet avis.');
        }

        if ($this->isCsrfTokenValid('delete' . $review->getId(), $request->request->get('_token'))) {
            $flanId = $review->getFlan()->getId();
            $entityManager->remove($review);
            $entityManager->flush();

            return $this->redirectToRoute('flan_detail', ['id' => $flanId]);
        }

        return $this->redirectToRoute('flan');
    }
}
