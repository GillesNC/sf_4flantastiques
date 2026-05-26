<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Entity\Flan;
use App\Entity\User;
use App\Repository\FavoriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FavoriteController extends AbstractController
{
    #[Route('/favorite/toggle/{id}', name: 'favorite_toggle', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function toggle(Flan $flan, FavoriteRepository $favoriteRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        $existingFavorite = $favoriteRepository->findOneByUserAndFlan($user, $flan);

        if ($existingFavorite) {
            $entityManager->remove($existingFavorite);
            $this->addFlash('success', 'Flan retiré de vos favoris.');
        } else {
            $favorite = new Favorite();
            $favorite->setUser($user);
            $favorite->setFlan($flan);
            $entityManager->persist($favorite);
            $this->addFlash('success', 'Flan ajouté à vos favoris !');
        }

        $entityManager->flush();

        return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('home'));
    }
}
