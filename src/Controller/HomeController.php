<?php

namespace App\Controller;

use App\Repository\CategorieHorlogeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategorieHorlogeRepository $categorieHorlogeRepository): Response
    {
        // Récupère les 3 dernières horloges ajoutées
        $dernieresHorloges = $categorieHorlogeRepository->findBy(
            [],
            ['id' => 'DESC'], 
            4
        );

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'dernieresHorloges' => $dernieresHorloges,
        ]);
    }
}