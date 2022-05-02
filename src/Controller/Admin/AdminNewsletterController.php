<?php
namespace App\Controller\Admin;


use App\Classe\Mail;
use App\Entity\Newsletter;
use App\Form\ContenuMailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncode;

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

        $to = [];
        $addresses = $entityManager->getRepository(Newsletter::class)->findAll();
        foreach($addresses as $addresse){
            $to[] = ['Email'=>$addresse->getEmail()];
        }
      
        $mail->sendMultiple($to,$contenuMail->getObjet(), $contenuMail->getTexte());

        $this->addFlash(
            'envoi',
            'Votre message a bien été envoyé aux abonnés de la newletter'
        );


        unset($mail);
        unset($formContenuMail);
        $mail = new Mail();
        $formContenuMail = $this->createForm(ContenuMailType::class);

        }


        
        return $this->render('admin_newsletter/index.html.twig',[
            'formContenuMail'=>$formContenuMail->createView(),
        ]);
    }
}