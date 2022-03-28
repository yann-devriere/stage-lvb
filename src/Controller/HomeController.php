<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Newsletter;
use App\Entity\ContenuMail;
use App\Entity\SlideAccueil;
use App\Form\ContenuMailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function index(EntityManagerInterface $entityManager, Request $request ): Response
    {
       $photoSlide = $entityManager->getRepository(SlideAccueil::class)->findVisible();
        return $this->render('home/index.html.twig',[
            'photoSlide'=>$photoSlide,
        ]);
    }
}
