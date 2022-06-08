<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Contact;
use App\Entity\Horaires;
use App\Entity\SlideSalle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfospratiquesController extends AbstractController
{
    #[Route('/infos-pratiques', name: 'infos-pratiques')]
    public function index(EntityManagerInterface $entityManager): Response
    {



        $photoSlide = $entityManager->getRepository(SlideSalle::class)->findVisible();
        $contact = $entityManager->getRepository(Contact::class)->findOneById(1);

        return $this->render(
            'infospratiques/index.html.twig',
            [
                'photoSlide' => $photoSlide,
                'contact'=>$contact,
            ]
        );
    }
}
