<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Booking;
use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\DossierInscription;
use App\Entity\Horaires;
use App\Entity\SlideSalle;
use App\Entity\MotDuPresident;
use App\Entity\Newsletter;
use App\Entity\PhotosQuiSommesNous;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\TexteQuiSommesNous as EntityTexteQuiSommesNous;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SectionMenuItem;
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
        yield MenuItem::linkToRoute("Retour au site",'fas fa-arrow-left','home' );

        yield MenuItem::section('Contact');
        yield MenuItem::linkToCrud("Coordonnées",'fas fa-address-card', Contact::class );

        yield MenuItem::section('Contenu');

        yield MenuItem::subMenu('Page "actu/news"')->setSubItems([
             MenuItem::linkToCrud("Catégories d'article", 'fas fa-hashtag', Categorie::class),
             MenuItem::linkToCrud("Article/Actus", 'fas fa-newspaper', Article::class),
        ]);

       yield MenuItem::subMenu('Page "Infos-pratiques"')->setSubItems([
             MenuItem::linkToCrud("Diapo présentation salle", 'fas fa-images', SlideSalle::class),
            ]);

       yield MenuItem::subMenu('Page "Inscription"')->setSubItems([
             MenuItem::linkToCrud("Dossier d'inscription", 'fas fa-file', DossierInscription::class),
            ]);
            
            
            yield  MenuItem::subMenu("Page d'accueille")->setSubItems([
            MenuItem::linkToCrud("Horaires des entraînements",'fas fa-clock', Horaires::class ),
            MenuItem::linkToCrud("Agenda",'fas fa-calendar',Booking::class ),
            MenuItem::linkToCrud("Mots des membres du bureau",'fas fa-quote-left', MotDuPresident::class ),
        ]);
        
        yield MenuItem::subMenu('Page "Qui sommes-nous?"')->setSubItems([
            MenuItem::linkToCrud("Contenu texte",'fas fa-feather',EntityTexteQuiSommesNous::class ),
            MenuItem::linkToCrud("Photos du diaporama",'fas fa-images',PhotosQuiSommesNous::class ),
        ]);

        yield MenuItem::section('Galerie photos');
        yield   MenuItem::linkToRoute("Albums photos",'fas fa-images','album_index' );

        yield MenuItem::section('Newsletter');
        yield MenuItem::linkToRoute("Newsletter",'fas fa-envelope','admin_newsletter' );
        
        yield MenuItem::section('Inscrits');
        yield MenuItem::linkToCrud("Verification des membres", 'fas fa-users', User::class);
        yield MenuItem::linkToCrud("Inscrits à la newsletter", 'fas fa-at', Newsletter::class);


             
    }
}

