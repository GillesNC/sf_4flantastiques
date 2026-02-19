<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpotController extends AbstractController
{
    #[Route('/explorer', name: 'spot')]
    public function index(): Response
    {
        return $this->render('spot/index.html.twig', [
            'controller_name' => 'SpotController',
        ]);
    }
}
