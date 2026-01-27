<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MembreController extends AbstractController
{
    #[Route('/devenir-membre', name: 'app_devenir_membre')]
    #[IsGranted('ROLE_USER')] // L'utilisateur doit être connecté
    public function devenirMembre(EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        // Vérifier si l'utilisateur a déjà le rôle ROLE_MEMBRE
        if (in_array('ROLE_MEMBRE', $user->getRoles())) {
            $this->addFlash('info', 'Vous êtes déjà membre premium.');
            return $this->redirectToRoute('app_home');
        }

        // Ajouter le rôle ROLE_MEMBRE
        $roles = $user->getRoles();
        $roles[] = 'ROLE_MEMBRE';
        $user->setRoles($roles);

        $entityManager->flush();

        $this->addFlash('success', 'Félicitations ! Vous êtes maintenant membre premium du Cercle des Collectionneurs Passionnés.');
        
        return $this->redirectToRoute('app_home');
    }
}