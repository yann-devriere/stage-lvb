<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Images;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GalerieController extends AbstractController
{

    private $entityManager;
    private $paginator;
    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
    }

    #[Route('/galerie', name: 'galerie')]
    public function index(): Response
    {

        $albums = $this->entityManager->getRepository(Album::class)->findAll();

        $photo = [];
        foreach ($albums as $album){
        $photos[]= $this->entityManager->getRepository(Images::class)->findOneByAlbum($album->getId()); 
        }
// dd($photos);

        return $this->render('galerie/index.html.twig', [
            'controller_name' => 'GalerieController',
            'albums'=> $albums,
            'photos'=>$photos,
        ]);
    }



    #[Route('/galerie/{id}', name: 'galerie_album')]
    public function album(PaginatorInterface $paginator,$id,Request $request): Response
    {
        $photos = $this->entityManager->getRepository(Images::class)->findByAlbum($id); 
        // dd($photos);
        $photos = $paginator->paginate(
            $photos, /* query NOT result */
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('galerie/album.html.twig', [
            'photos'=>$photos,
        ]);
    }




}
