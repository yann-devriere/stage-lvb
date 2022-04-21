<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Article;
use App\Entity\Booking;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ActuController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/actualite-du-club', name: 'actu')]
    
    
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        
        $search = new Search;
        $formFiltres = $this->createForm(SearchType::class, $search);

        $formFiltres->handleRequest($request);

        if($formFiltres->isSubmitted() && $formFiltres->isValid()){
            $articles = $this->entityManager->getRepository(Article::class)->findWithSearch($search);
        } else{
            $articles = $this->entityManager->getRepository(Article::class)->findAll();
        }



        $search2 = new Search;

        $formFiltres2 = $this->createForm(SearchType::class, $search2);

        $formFiltres2->handleRequest($request);

        if($formFiltres2->isSubmitted() && $formFiltres2->isValid()){
            $articles = $this->entityManager->getRepository(Article::class)->findWithSearch($search2);
        
        } else{
            $articles = $this->entityManager->getRepository(Article::class)->findAll();
        }


        $articles = $paginator->paginate(
            $articles, /* query NOT result */
            $request->query->getInt('page', 1),
            4
        );


        $events=$this->entityManager->getRepository(Booking::class)->findAll();

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




        return $this->render('actu/index.html.twig',[
            'formFiltres'=>$formFiltres->createView(),
            'formFiltres2'=>$formFiltres2->createView(),
            'articles' => $articles,
            'data'=>$data,

        ]);
    }
}
