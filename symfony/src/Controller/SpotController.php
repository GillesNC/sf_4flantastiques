<?php

namespace App\Controller;

use App\Entity\Flan;
use App\Entity\Spot;
use App\Repository\CityRepository;
use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Map\Map;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\Point;
use Symfony\UX\Map\InfoWindow;

final class SpotController extends AbstractController
{
    #[Route('/explorer', name: 'spot', methods: ['GET'])]
    public function index(SpotRepository $spotRepository, CityRepository $cityRepository): Response
    {
        $spots = $spotRepository->findAll();
        $cities = $cityRepository->findAll();

        //Section MAP
        $map = (new Map())
            ->center(new Point(48.8566, 2.3522))
            ->zoom(8);

        foreach ($spots as $spot) {
            $map->addMarker(new Marker(
                position: new Point($spot->getLatitude(), $spot->getLongitude()),
                title: $spot->getName(),
                infoWindow: new InfoWindow(
                    headerContent: '<b class="text-sm text-secondary">' . $spot->getName() . '</b>',
                    content: '<p class="text-sm">' . $spot->getBio() . '</p>'
                ),
            ));
        }

        return $this->render('spot/index.html.twig', [
            'spots' => $spots,
            'cities' => $cities,
            'map' => $map,
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
