<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpotController extends AbstractController
{
    #[Route('/explorer', name: 'spot', methods: ['GET'])]
    public function index(SpotRepository $spotRepository): Response
    {
        $spots = $spotRepository->findAll();
        return $this->render('spot/index.html.twig', [
            'spots' => $spots,
        ]);
    }
}
