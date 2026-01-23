<?php

namespace App\Controller;

use App\Entity\CategorieHorloge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallery')]
class DeleteHorlogeController extends AbstractController
{
    #[Route('/gallery/{id}/delete', name: 'categorie_horloge_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieHorloge $cat, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($cat->getUser() !== $this->getUser()) {
            $this->addFlash('error', 'Vous ne pouvez pas supprimer cette horloge !');
            return $this->redirectToRoute('gallery_index');
        }

        if ($this->isCsrfTokenValid('delete'.$cat->getId(), $request->request->get('_token'))) {
            $em->remove($cat);
            $em->flush();
            $this->addFlash('success', 'Horloge supprimée avec succès');
        }

        return $this->redirectToRoute('app_gallery');
    }

}
