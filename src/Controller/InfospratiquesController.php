<?php

namespace App\Controller;

use App\Entity\Booking;
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



        $events=$entityManager->getRepository(Booking::class)->findAll();

        $evenements=[];
        foreach($events as $event)
        {if(!$event->getEndAt()){
            $evenements[] = [
                'title'=>$event->getTitle(),
                'start'=>date_format($event->getBeginAt(),'Y-m-d'),
                'end'=>null
                ];
            }else{
                $evenements[] = [
                    'title'=>$event->getTitle(),
                    'start'=>date_format($event->getBeginAt(),'Y-m-d'),
                    'end'=>date_format($event->getEndAt(),'Y-m-d')
                    ];

            }
        }
        $evenements[]=[
            'title'=>'Entraînement',
            'startTime'=>'19-00-000',
            'endTime'=>'22-30-000',
            'daysOfWeek'=>'3',
                ];

                $evenements[]=[
                    'title'=>'Entraînement',
                    'startTime'=>'19-30-000',
                    'endTime'=>'22-30-000',
                    'daysOfWeek'=>'5',
                        ];
        $data = json_encode($evenements);


        $photoSlide = $entityManager->getRepository(SlideSalle::class)->findVisible();
        return $this->render('infospratiques/index.html.twig',[
            'photoSlide'=>$photoSlide,
            'data'=>$data,

        ]
    );
    }
}
