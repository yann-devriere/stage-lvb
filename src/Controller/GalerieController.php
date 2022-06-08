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
       
        if ($this->getUser()==null or $this->getUser()->getMembre() == false ){

            $vide=null;
            $albums = $this->entityManager->getRepository(Album::class)->findByPublic(true);
            if ($albums == null){
                $vide="Aucun album n'est accessible pour le moment";
                $photos=null;
            } else {
                $photo = [];
                foreach ($albums as $album){
                $photos[]= $this->entityManager->getRepository(Images::class)->findOneByAlbum($album->getId()); 
            }

            }


        }else{


            $vide=null;
            $albums = $this->entityManager->getRepository(Album::class)->findAll();
            // $albums=null;
            if ($albums == null){
                $vide="Aucun album n'est accessible pour le moment";
                $photos=null;
            } else {
                $photo = [];
                foreach ($albums as $album){
                $photos[]= $this->entityManager->getRepository(Images::class)->findOneByAlbum($album->getId()); 
            }

            }

        }

        return $this->render('galerie/index.html.twig', [
            'albums'=> $albums,
            'photos'=>$photos,
            'vide'=>$vide,
        ]);
    }



    #[Route('/galerie/{id}', name: 'galerie_album')]
    public function album(PaginatorInterface $paginator,$id,Request $request): Response
    {
        $album = $this->entityManager->getRepository(Album::class)->findOneById($id);
        // $album=null;

        if($album == null){

            $this->addFlash('noalbum',"L'album photo que vous cherchez à voir n'existe pas.");
            return $this->redirectToRoute('galerie');
            
            
        }else{

            if($album->getPublic()==true){

                $photos = $this->entityManager->getRepository(Images::class)->findByAlbum($id); 
                // dd($photos);
                 $photos = $paginator->paginate(
                $photos, /* query NOT result */
                $request->query->getInt('page', 1),
                9
            );


            }else{
                if ($this->getUser()==null or $this->getUser()->getMembre() == false ){
                    $this->addFlash('danger', "Vous devez être connecté à un compte verrifié par l'administrateur pour accéder à cette partie du site.");
                    return $this->redirectToRoute('galerie');
                }else{
                    
                        $photos = $this->entityManager->getRepository(Images::class)->findByAlbum($id); 

                        $photos = $paginator->paginate(
                        $photos, /* query NOT result */
                        $request->query->getInt('page', 1),
                        9
                    );
                }
            }

        

        return $this->render('galerie/album.html.twig', [
            'photos'=>$photos,
            'album'=>$album,
            
        ]);
    }




}
}