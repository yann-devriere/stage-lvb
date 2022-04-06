<?php
namespace App\Controller\Admin;


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

class AdminNewsletterController extends AbstractController
{
    /**
     * @Route("/admin/newsletter", name="admin_newsletter")
     */

    public function index(EntityManagerInterface $entityManager, Request $request ): Response
    {


            $formContenuMail = $this->createForm(ContenuMailType::class);


        $formContenuMail->handleRequest($request);

        if($formContenuMail->isSubmitted() && $formContenuMail->isValid()){
            $contenuMail = $formContenuMail->getData(); 

            

            $mail = new Mail;

        $adressesCibles = $entityManager->getRepository(Newsletter::class)->findAll();

        $mail->sendMultiple($adressesCibles,$contenuMail->getObjet(), $contenuMail->getTexte());

        }

        
        return $this->render('admin_newsletter/index.html.twig',[
            'formContenuMail'=>$formContenuMail->createView(),
        ]);
    }
}