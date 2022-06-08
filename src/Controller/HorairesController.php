<?php

namespace App\Controller;

use App\Entity\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorairesController extends AbstractController
{
    #[Route('/horaires', name: 'horaires')]
    public function index( EntityManagerInterface $em): Response
    {

        $horaires= $em->getRepository(Horaires::class)->findOneById(1);

        return $this->render('horaires/index.html.twig', [
            'horaires'=>$horaires,
        ]);
    }
}
