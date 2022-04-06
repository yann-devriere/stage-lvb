<?php

namespace App\Controller;

use App\Entity\SlideAccueil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfospratiquesController extends AbstractController
{
    #[Route('/infos-pratiques', name: 'infos-pratiques')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $photoSlide = $entityManager->getRepository(SlideAccueil::class)->findVisible();
        return $this->render('infospratiques/index.html.twig',[
            'photoSlide'=>$photoSlide,
        ]
    );
    }
}
