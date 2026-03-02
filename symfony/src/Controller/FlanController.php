<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Flan;
use App\Entity\Spot;
use App\Repository\FlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/{id}', name: 'flan_detail', methods: ['GET'])]
    public function detailFlan(Flan $flan): Response
    {
        $spot = $flan->getSpot();

        return $this->render('flan/detailFlan.html.twig', [
            'flan' => $flan,
            'spot' => $spot,
        ]);
    }
}
