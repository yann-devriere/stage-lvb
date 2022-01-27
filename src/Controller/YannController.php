<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YannController extends AbstractController
{
    /**
     * @Route("/yann", name="yann")
     */
    public function index(): Response
    {
        return $this->render('yann/index.html.twig');
    }
}
