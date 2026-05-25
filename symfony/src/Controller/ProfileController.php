<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Flan;
use App\Entity\Spot;
use App\Entity\User;
use App\Form\FlanFormType;
use App\Form\ProfileFormType;
use App\Form\SpotFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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

    #[Route('/add/{id}', name: 'profile_flan', methods: ['GET', 'POST'])]
    public function flan(Request $request, User $user, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $flan = new Flan();
        $formFlan = $this->createForm(FlanFormType::class, $flan);
        $formFlan->handleRequest($request);

        $spot = new Spot();
        $formSpot = $this->createForm(SpotFormType::class, $spot);
        $formSpot->handleRequest($request);

        // TRAITEMENT DU FORMULAIRE FLAN
        if ($formFlan->isSubmitted() && $formFlan->isValid()) {
            $flan->setUserId($user);
            $photoFile = $formFlan->get('photo')->getData();

            if ($photoFile) {
//            dd($photoFile);
                $document = new Document();

                $document->setDocumentFile($photoFile);
                $document->setCreatedAt(new \DateTimeImmutable());

                $entityManager->persist($document);
                $flan->addDocument($document);
            }

            $entityManager->persist($flan);
            $entityManager->flush();

            $this->addFlash('success', 'Flan ajouté avec succès !');
            return $this->redirectToRoute('profile_show', ['id' => $user->getId()]);
        } else if ($formFlan->isSubmitted() && !$formFlan->isValid()) {
            $this->addFlash('error', 'Erreur lors de l\'ajout du flan. Veuillez vérifier les informations saisies.');
        }

        // TRAITEMENT DU FORMULAIRE SPOT
        if ($formSpot->isSubmitted() && $formSpot->isValid()) {
            $spot->setUser($user);

            $photoFile = $formSpot->get('photo')->getData();

            if ($photoFile) {
                $document = new Document();
                $document->setDocumentFile($photoFile);
                $document->setCreatedAt(new \DateTimeImmutable());

                $entityManager->persist($document);
                $spot->addDocument($document);
            }

            $entityManager->persist($spot);
            $entityManager->flush();

            $this->addFlash('success', 'Spot ajouté avec succès !');
            return $this->redirectToRoute('profile_show', ['id' => $user->getId()]);
        } else if ($formSpot->isSubmitted() && !$formSpot->isValid()) {
            $this->addFlash('error', 'Erreur lors de l\'ajout du spot. Veuillez vérifier les informations saisies.');
        }

        return $this->render('profile/add.html.twig', [
            'user' => $user,
            'formFlan' => $formFlan,
            'formSpot' => $formSpot,
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
        return $this->render('profile/ugc.html.twig', [
            'user' => $user,
        ]);
    }
}
