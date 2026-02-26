<?php

namespace App\Controller;

use App\Repository\FlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RankingController extends AbstractController
{
    #[Route('/ranking', name: 'ranking')]
    public function index(FlanRepository $flanRepository): Response
    {
        $flans = $flanRepository->findAll();

        return $this->render('ranking/index.html.twig', [
            'flans' => $flans,
        ]);
    }
}
