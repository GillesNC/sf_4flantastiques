<?php

namespace App\Controller;

use App\Repository\FlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FlanController extends AbstractController
{
    #[Route('/flan', name: 'flan')]
    public function index(FlanRepository $flanRepository): Response
    {
        $flan = $flanRepository->findAll();

        return $this->render('flan/index.html.twig', [
            'controller_name' => 'FlanController',
            'flans' => $flan
        ]);
    }
}
