<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('4 Flantastiques')
            ->setFaviconPath('favicon.ico')
            ->setTranslationDomain('admin');
    }

    public function configureMenuItems(): iterable
    {
        return [
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            yield MenuItem::section('Gestion des entités'),
            yield MenuItem::linkTo(UserCrudController::class, 'Users', 'fa-solid fa-users')
            ->setAction(Action::INDEX),

            yield MenuItem::linkTo(FlanCrudController::class, 'Flan', 'fa-solid fa-cake-candles')
            ->setAction(Action::INDEX),

            yield MenuItem::linkTo(SpotCrudController::class, 'Spots', 'fa-solid fa-map-marker-alt')
            ->setAction(Action::INDEX),

            yield MenuItem::linkTo(CityCrudController::class, 'Cities', 'fa-solid fa-city')
            ->setAction(Action::INDEX),

            yield MenuItem::linkTo(ReviewCrudController::class, 'Reviews', 'fa-solid fa-star')
            ->setAction(Action::INDEX),

            yield MenuItem::linkToRoute('Back to the website', 'fa-solid fa-arrow-left', 'home'),
        ];
    }
}
