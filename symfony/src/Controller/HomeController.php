<?php

namespace App\Controller;

use App\Repository\CityRepository;
use App\Repository\FlanRepository;
use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(FlanRepository $flanRepository, SpotRepository $spotRepository, CityRepository $cityRepository): Response
    {
        $dataFlans = $flanRepository->findAll();
        $spots = $spotRepository->findAll();
        $dataCities = $cityRepository->findAll();

        $flans = array_slice($dataFlans, 0, 5);
        $cities = array_slice($dataCities, 0, 10);

        return $this->render('home/index.html.twig', [
            'flans' => $flans,
            'spots' => $spots,
            'cities' => $cities,
        ]);
    }
}
