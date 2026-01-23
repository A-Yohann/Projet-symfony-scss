<?php

namespace App\Controller;

use App\Repository\CategorieHorlogeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallery')]
class GalleryController extends AbstractController
{
    #[Route('/', name: 'app_gallery')]
    public function index(CategorieHorlogeRepository $repo): Response
    {
        $categories = $repo->findAll();

        return $this->render('gallery/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
