<?php

namespace App\Controller;

use App\Entity\City;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/city')]
final class CityController extends AbstractController
{
    #[Route('/', name: 'city')]
    public function index(CityRepository $cityRepository): Response
    {
        $cities = $cityRepository->findAll();

        return $this->render('city/index.html.twig', [
            'cities' => $cities,
        ]);
    }

    #[Route('/{id}', name: 'city_detail')]
    public function detailCity(City $city): Response
    {
        $spots = $city->getSpots();

        return $this->render('city/detailCity.html.twig', [
            'city' => $city,
            'spots' => $spots,
        ]);
    }
}

