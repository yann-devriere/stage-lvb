<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Article;
use App\Entity\Booking;
use App\Entity\Categorie;
use App\Entity\PhotosQuiSommesNous;
use App\Entity\SlideSalle;
use App\Entity\TexteQuiSommesNous as EntityTexteQuiSommesNous;
use App\Entity\User;
use App\Repository\TexteQuiSommesNous;
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
        yield MenuItem::linkToCrud("Verification des membres", 'fas fa-list', User::class);
        yield MenuItem::linkToCrud("Catégories d'article", 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud("Articles", 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud("Diapo présentation salle", 'fas fa-list', SlideSalle::class);
        yield MenuItem::linkToRoute("Newsletter",'fas fa-list','admin_newsletter' );
        yield MenuItem::linkToCrud("Agenda",'fas fa-list',Booking::class );
        yield MenuItem::linkToCrud("Photo page qui sommes nous ?",'fas fa-list',PhotosQuiSommesNous::class );
        yield MenuItem::linkToCrud("Texte page qui sommes nous ?",'fas fa-list',EntityTexteQuiSommesNous::class );
    }
}

