<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    #[Route('/email', name: 'email')]
    public function index(EntityManagerInterface $em): Response
    {
        $contact=$em->getRepository(Contact::class)->findOneById(1);
        if($contact != null){
            $email = $contact->getEmail();
        }else{
            $email=null;
        }

        return $this->render('email/index.html.twig', [
            'email'=>$email,
        ]);
    }
}
