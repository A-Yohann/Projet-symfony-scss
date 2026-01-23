<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorlogeController extends AbstractController
{
    #[Route('/horloge', name: 'horloge')]
    public function index(): Response
    {
        return $this->render('horloge/horloge.html.twig');
    }
}
