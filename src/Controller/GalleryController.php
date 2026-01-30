<?php

namespace App\Controller;

use App\Repository\CategorieHorlogeRepository;
use App\Form\HorlogeFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallery')]
class GalleryController extends AbstractController
{
    #[Route('/', name: 'app_gallery')]
    public function index(
        Request $request,
        CategorieHorlogeRepository $categorieHorlogeRepository
    ): Response {
        // Création du formulaire de filtre
        $form = $this->createForm(HorlogeFilterType::class);
        $form->handleRequest($request);

        // Par défaut : toutes les horloges
        $horloges = $categorieHorlogeRepository->findAll();

        // Si filtre actif
        if ($form->isSubmitted() && $form->isValid()) {
            $mecanismesSelectionnes = $form->get('mecanismes')->getData();

            if ($mecanismesSelectionnes && count($mecanismesSelectionnes) > 0) {
                // Convertir ArrayCollection en array
                $mecanismesArray = $mecanismesSelectionnes->toArray();
                $horloges = $categorieHorlogeRepository->findByMecanismes($mecanismesArray);
            }
        }

        return $this->render('gallery/index.html.twig', [
            'horloges'   => $horloges,
            'filterForm'=> $form->createView(),
        ]);
    }
}