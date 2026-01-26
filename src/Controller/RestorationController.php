<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RestorationController extends AbstractController
{
    // Page principale accessible à tous les utilisateurs connectés
    #[Route('/restoration', name: 'app_restoration')]
    public function index(): Response
    {
        return $this->render('restoration/index.html.twig');
    }

    // Guides spécifiques, seulement pour les adhérents
    #[Route('/restauration/base', name: 'app_restoration_basic')]
    #[IsGranted('ROLE_ADHERENT')]
    public function basic(): Response
    {
        return $this->render('restoration/basic.html.twig');
    }

    #[Route('/restauration/avancee', name: 'app_restoration_advanced')]
    #[IsGranted('ROLE_ADHERENT')]
    public function advanced(): Response
    {
        return $this->render('restoration/advanced.html.twig');
    }

    #[Route('/restauration/conservation', name: 'app_restoration_optimal')]
    #[IsGranted('ROLE_ADHERENT')]
    public function conservation(): Response
    {
        return $this->render('restoration/optimal.html.twig');
    }
}
