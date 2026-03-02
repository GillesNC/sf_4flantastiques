<?php

namespace App\Controller;

use App\Entity\Flan;
use App\Entity\Spot;
use App\Repository\CityRepository;
use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpotController extends AbstractController
{
    #[Route('/explorer', name: 'spot', methods: ['GET'])]
    public function index(SpotRepository $spotRepository, CityRepository $cityRepository): Response
    {
        $spots = $spotRepository->findAll();
        $cities = $cityRepository->findAll();

        return $this->render('spot/index.html.twig', [
            'spots' => $spots,
            'cities' => $cities,
        ]);
    }

    #[Route('/spot/{id}', name: 'spot_detail', methods: ['GET'])]
    public function detailSpot(Spot $spot): Response
    {
        $flan = $spot->getFlans();

        return $this->render('spot/detailSpot.html.twig', [
            'spot' => $spot,
            'flan' => $flan
        ]);
    }

}
