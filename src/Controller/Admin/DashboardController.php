<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SlideAccueil;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        {
            // redirect to some CRUD controller
            $routeBuilder = $this->get(AdminUrlGenerator::class);
    
            return $this->redirect($routeBuilder->setController(ArticleCrudController::class)->generateUrl());
    
        }
    
        // ...

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Starter Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud("Catégories d'article", 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud("Articles", 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud("Diaporama accueil", 'fas fa-list', SlideAccueil::class);
        yield MenuItem::linkToRoute("Newsletter",'fas fa-list','admin_newsletter' );
    }
}