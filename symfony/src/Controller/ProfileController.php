<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
final class ProfileController extends AbstractController
{
    #[Route('/show/{id}', name: 'profile_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/edit/{id}', name: 'profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            }
            $entityManager->flush();

            return $this->redirectToRoute('profile_show', ['id' => $user->getId()]);
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/reviews/{id}', name: 'profile_reviews', methods: ['GET'])]
    public function reviews(User $user): Response
    {
        return $this->render('profile/reviews.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/flan/{id}', name: 'profile_flan')]
    public function flan(User $user): Response
    {
        return $this->render('profile/flan.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/favorites/{id}', name: 'profile_favorites', methods: ['GET'])]
    public function favorites(User $user): Response
    {
        return $this->render('profile/favorites.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/ugc/{id}', name: 'profile_ugc')]
    public function ugc(User $user): Response
    {
        return $this->render('profile/ugc.html.twig',[
            'user' => $user,
        ]);
    }
}
