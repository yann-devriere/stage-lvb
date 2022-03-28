<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Article;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
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
    
    
    public function index(Request $request): Response
    {

        
        $search = new Search;
        $formFiltres = $this->createForm(SearchType::class, $search);

        $formFiltres->handleRequest($request);

        if($formFiltres->isSubmitted() && $formFiltres->isValid()){
            $articles = $this->entityManager->getRepository(Article::class)->findWithSearch($search);
        } else{
            $articles = $this->entityManager->getRepository(Article::class)->findAll();
        }


        $formNewsletter = $this->createForm(NewsletterType::class);




        $newsletter = new Newsletter;

        $formNewsletter->handleRequest($request);

        if($formNewsletter->isSubmitted() && $formNewsletter->isValid()){
            $nouveauMail = $formNewsletter->getData();
            $verifMail = $this->entityManager->getRepository(Newsletter::class)->findOneBy(['email'=>$nouveauMail->getEmail()]);

            if(!$verifMail){
            $newsletter = $formNewsletter->getData();
            $this->entityManager->persist($newsletter);
            $this->entityManager->flush();
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

        return $this->render('actu/index.html.twig',[
            'formFiltres'=>$formFiltres->createView(),
            'formNewsletter'=>$formNewsletter->createView(),
            'articles' => $articles,

        ]);
    }
}
