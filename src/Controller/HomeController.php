<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Album;
use App\Entity\Images;
use App\Entity\Article;

use App\Entity\Booking;
use App\Entity\Horaires;
use App\Entity\MotDuPresident;
use App\Entity\Newsletter;

use App\Form\NewsletterType;
use DateTime;
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

        //generation et traitement du formulaire d'inscription à la newsletter

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


        // Approvisionnement du tableau d'evenement pour full-calendar
        
        $events = $entityManager->getRepository(Booking::class)->findFuturs();

        $evenements = [];

        if($events != null){
            foreach ($events as $event) {
    
                $end = ($event->getEndAt()) ? date_format($event->getEndAt(), 'Y-m-d') : null;
    
                $evenements[] = [
                    'title' => $event->getTitle(),
                    'start' => date_format($event->getBeginAt(), 'Y-m-d'),
                    'end' => $end,
    
                ];
            }
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



        //Recuperation des photos en accès public et tri aléatoire pour n'en garder que 9 au maximum
        $albums = $entityManager->getRepository(Album::class)->findByPublic(true);
        if($albums == null){
            $photosVisibles = null;
        }else{
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

        }



        //Recuperation des articles ayant été cochés comme accessibles en page d'accueil
        $articlesSlide = $entityManager->getRepository(Article::class)->findBy(['page_d_accueil' => 'true']);
        
        if($articlesSlide != null){    
            if(count($articlesSlide)>3){
                shuffle($articlesSlide);
                $articlesSlide = array_slice($articlesSlide,0,3,true);
            }
        }



        //Recuperation des entités MotDuPresident pour remplir le carousel prévu à cet effet et tri pour n'en garder que trois
        $mots = $entityManager->getRepository(MotDuPresident::class)->findAll();
        // if($mots != null){
        //     if(count($mots)>3){
        //         $mots = array_slice($mots,0,3,true);
        //     }
        // }

            //recuperation des horaires d'entrainement
        $horaires = $entityManager->getRepository(Horaires::class)->findOneById(1);

            //calcul du nombre d'années d'existence du club
            $années= new DateTime();
            $existence=date_format($années,'Y') - 2013;

        return $this->render('home/index.html.twig',[
            'articlesSlide'=>$articlesSlide,
            'formNewsletter'=>$formNewsletter->createView(),
            // 'formNewsletter2'=>$formNewsletter2->createView(),
            'data' => $data,
            'photos'=>$photosVisibles,
            'mots'=>$mots,
            'horaires'=>$horaires,
            'existence'=>$existence
        ]);
    }
}
