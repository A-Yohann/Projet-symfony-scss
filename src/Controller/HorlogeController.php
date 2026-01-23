<?php

namespace App\Controller;

use App\Repository\CategorieHorlogeRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorlogeController extends AbstractController
{
    #[Route('/horloge', name: 'horloge')]
    public function index(CategorieHorlogeRepository $categorieHorlogeRepository): Response
    {
        $categories = $categorieHorlogeRepository->findAll();

        return $this->render('horloge/horloge.html.twig', [
            'categories' => $categories, 
        ]);
    }
}
