<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleUniqueController extends AbstractController

{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/article/{{nom}}', name: 'article_unique')]
    public function index($nom): Response
    {

        $article = $this->em->getRepository(Article::class)->findOneByNom($nom);

        $AllCategories = $this->em->getRepository(Categorie::class)->findAll();

        $articles = $this->em->getRepository(Article::class)->findAll();

        rsort($articles);
        
        if(count($articles)>3){
            $articlesPreview = array_slice($articles,0,3,true);
        }else{
            $articlesPreview = $articles;
        }

        // dd($articlesPreview);



        return $this->render('article_unique/index.html.twig', [
            'article' => $article,
            'AllCategories'=>$AllCategories,
            'articlesPreview'=>$articlesPreview,
        ]);
    }
}
