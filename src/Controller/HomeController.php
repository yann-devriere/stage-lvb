<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Article;
use App\Entity\Newsletter;
use App\Form\NewsletterType;

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

        $formNewsletter = $this->createForm(NewsletterType::class);


        $newsletter = new Newsletter;

        $formNewsletter->handleRequest($request);

        if($formNewsletter->isSubmitted() && $formNewsletter->isValid()){
            $nouveauMail = $formNewsletter->getData();
            $verifMail = $entityManager->getRepository(Newsletter::class)->findOneBy(['email'=>$nouveauMail->getEmail()]);

            if(!$verifMail){
            $newsletter = $formNewsletter->getData();

            // $mail = new Mail;
            // $mail->ajoutListe($newsletter);

            $entityManager->persist($newsletter);
            $entityManager->flush();
            $this->addFlash(
                'inscriptionNL',
                'Votre inscription à la newletter à bien été prise en compte'
            );
            }else{
                $this->addFlash(
                    'inscriptionNL',
                    "L'adresse mail que vous avez renseignée est déjà utilisée"
                );

            }
        }



        
        $formNewsletter2 = $this->createForm(NewsletterType::class);


        $newsletter2 = new Newsletter;

        $formNewsletter2->handleRequest($request);

        if($formNewsletter2->isSubmitted() && $formNewsletter2->isValid()){
            $nouveauMail = $formNewsletter2->getData();
            $verifMail = $entityManager->getRepository(Newsletter::class)->findOneBy(['email'=>$nouveauMail->getEmail()]);

            if(!$verifMail){
            $newsletter2 = $formNewsletter2->getData();

            $mail = new Mail;
            $mail->ajoutListe($newsletter);

            $entityManager->persist($newsletter2);
            $entityManager->flush();
            $this->addFlash(
                'inscriptionNL2',
                'Votre inscription à la newletter à bien été prise en compte'
            );
            }else{
                $this->addFlash(
                    'inscriptionNL2',
                    "L'adresse mail que vous avez renseignée est déjà utilisée"
                );

            }
        }


        
        $articlesSlide = $entityManager->getRepository(Article::class)->findBy(['page_d_accueil' => 'true']);
        return $this->render('home/index.html.twig',[
            'articlesSlide'=>$articlesSlide,
            'formNewsletter'=>$formNewsletter->createView(),
            'formNewsletter2'=>$formNewsletter2->createView(),
            

        ]);
    }
}
