<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Album;
use App\Entity\Images;
use App\Entity\Article;

use App\Entity\Booking;
use App\Entity\Newsletter;

use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

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



        
        // $formNewsletter2 = $this->createForm(NewsletterType::class);


        // $newsletter2 = new Newsletter;

        // $formNewsletter2->handleRequest($request);

        // if($formNewsletter2->isSubmitted() && $formNewsletter2->isValid()){
        //     $nouveauMail = $formNewsletter2->getData();
        //     $verifMail = $entityManager->getRepository(Newsletter::class)->findOneBy(['email'=>$nouveauMail->getEmail()]);

        //     if(!$verifMail){
        //     $newsletter2 = $formNewsletter2->getData();

        //     $mail = new Mail;
        //     $mail->ajoutListe($newsletter);

        //     $entityManager->persist($newsletter2);
        //     $entityManager->flush();
        //     $this->addFlash(
        //         'inscriptionNL2',
        //         'Votre inscription à la newletter à bien été prise en compte'
        //     );
        //     }else{
        //         $this->addFlash(
        //             'inscriptionNL2',
        //             "L'adresse mail que vous avez renseignée est déjà utilisée"
        //         );

        //     }
        // }

        
        $events = $entityManager->getRepository(Booking::class)->findAll();


        $evenements = [];
        foreach ($events as $event) {

            $end = ($event->getEndAt()) ? date_format($event->getEndAt(), 'Y-m-d') : null;

            $evenements[] = [
                'title' => $event->getTitle(),
                'start' => date_format($event->getBeginAt(), 'Y-m-d'),
                'end' => $end,

            ];
        }
        $evenements[] = [
            'title' => 'Entraînement',
            'startTime' => '19-00-000',
            'endTime' => '22-30-000',
            'daysOfWeek' => '3',
        ];

        $evenements[] = [
            'title' => 'Entraînement',
            'startTime' => '19-30-000',
            'endTime' => '22-30-000',
            'daysOfWeek' => '5',
        ];
        $data = json_encode($evenements);


        $albums = $entityManager->getRepository(Album::class)->findByPublic(true);

        $photo = [];
        foreach ($albums as $album){
        $photos= $entityManager->getRepository(Images::class)->findByAlbum($album->getId()); 
            foreach($photos as $selfie){
                $photo[]=$selfie;
            }
        }

         shuffle($photo);

        if(count($photo)>9){
            $photosVisibles = array_slice($photo,0,9,true);
        }else{
            $photosVisibles = $photo;
        }


        // dd($photosVisibles);


        
        $articlesSlide = $entityManager->getRepository(Article::class)->findBy(['page_d_accueil' => 'true']);
        return $this->render('home/index.html.twig',[
            'articlesSlide'=>$articlesSlide,
            'formNewsletter'=>$formNewsletter->createView(),
            // 'formNewsletter2'=>$formNewsletter2->createView(),
            'data' => $data,
            'photos'=>$photosVisibles,
        ]);
    }
}
