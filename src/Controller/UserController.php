<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Newsletter;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    private $entityManager ;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager ;
    }

    #[Route('/inscription', name: 'inscription')]
    public function index( Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $notification = null ;

        if(!$this->getUser()==null){
            $utilisateurCo=$this->getUser()->getEmail();
        }else{
            $utilisateurCo=null;
        }
        

        $user = new User();
        $newsletter = new Newsletter();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneBy(['email'=>$user->getEmail()]);
                if(!$search_email){
                    $password = $passwordHasher->hashPassword($user, $user->getPassword());
                    $user->setPassword($password);
                    $user->setMembre(false);

                    if($user->getNewsletter()==true){
                        $searchNews = $this->entityManager->getRepository(Newsletter::class)->findOneByEmail($user->getEmail());
                        if(!$searchNews){
                             $newsletter->setEmail($user->getEmail());
                             $this->entityManager->persist($newsletter);
                                        }
                    }
                   

                    $this->entityManager->persist($user);
                    
                    $this->entityManager->flush();

                    $mail = new Mail();
                    $content = "Bonjour ".$user->getPrenom()."<br/><br/> Bienvenue sur le site des Volants Berquinois.<br/><br/> Votre inscription a bien été prise en compte, vous pouvez dès à présent profiter des fonctionnalités que vous offre le site";
                    
                    $mail->send($user->getEmail(), $user->getPrenom(), 'Bienvenue chez les Volants Berquinois', $content);

                    $this->addFlash('success', 'Votre inscription a bien été prise en compte. Vous pouvez déjà vous connecter.');
                    return $this->redirectToRoute('connexion');
                    //ici ce sera le mail
                }else{
                    $notification = "L'email que vous avez renseigné est déjà utilisé par un compte existant.";
                }

        }

        return $this->render('user/index.html.twig',[
            'form' => $form->createView(),
            'notification' => $notification,
            'utilisateurCo'=> $utilisateurCo,
            
        ]);
    }
}
