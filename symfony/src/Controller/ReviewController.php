<?php

namespace App\Controller;

use App\Entity\Flan;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReviewController extends AbstractController
{
    #[Route('/review', name: 'review')]
    public function index(): Response
    {
        return $this->render('review/index.html.twig', [
            'controller_name' => 'ReviewController',
        ]);
    }

    #[Route('/review/edit/{id}', name: 'review_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Review $review, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $flan = $review->getFlan();

        if ($review->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à modifier cet avis.');
        }

        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('flan_detail', ['id' => $flan->getId()]);
        }
        return $this->render('review/edit.html.twig', [
            'form' => $form->createView(),
            'flan' => $flan,
            'review' => $review
        ]);
    }
}
