<?php

namespace App\Controller;

use App\Entity\CategorieHorloge;
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

    #[Route('/horloge/{id}', name: 'app_horloge_show')]
    public function show(CategorieHorloge $horloge): Response
    {
        return $this->render('horloge/show.html.twig', [
            'horloge' => $horloge,
        ]);
    }
}