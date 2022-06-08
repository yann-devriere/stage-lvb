<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\DossierInscription;
use App\Entity\Horaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription-club', name: 'inscription_club')]
    public function index(EntityManagerInterface $em): Response
    {
        $contact=$em->getRepository(Contact::class)->findOneById(1);
        if($contact != null){
            $email = $contact->getEmail();
        }else{
            $email=null;
        }

        $dossier=$em->getRepository(DossierInscription::class)->findOneById(1);


        $horaires=$em->getRepository(Horaires::class)->findOneById(1);



        return $this->render('inscription/index.html.twig', [
            'email'=>$email,
            'horaires'=>$horaires,
            'dossier'=>$dossier
        ]);
    }
}
