<?php

namespace App\Controller;

use App\Entity\PhotosQuiSommesNous;
use App\Entity\TexteQuiSommesNous;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuiSommesNousController extends AbstractController
{
    #[Route('/qui-sommes-nous', name: 'qui')]
    public function index(EntityManagerInterface $em): Response
    {

        $photoSlide= $em->getRepository(PhotosQuiSommesNous::class)->findByVisible(true);
        $texte = $em->getRepository(TexteQuiSommesNous::class)->findAll();

        return $this->render('qui_sommes_nous/index.html.twig', [
            'controller_name' => 'QuiSommesNousController',
            'photos'=>$photoSlide,
            'texte'=>$texte,
        ]);
    }
}
