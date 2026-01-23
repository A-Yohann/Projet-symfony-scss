<?php

namespace App\Controller;

use App\Entity\CategorieHorloge;
use App\Form\CategorieHorlogeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallery')]
class EditHorlogeController extends AbstractController
{
    #[Route('/gallery/{id}/edit', name: 'categorie_horloge_edit')]
public function edit(Request $request, CategorieHorloge $cat, EntityManagerInterface $em): Response
{
    $this->denyAccessUnlessGranted('ROLE_USER');

    if ($cat->getUser() !== $this->getUser()) {
        $this->addFlash('error', 'Vous ne pouvez pas modifier cette horloge !');
        return $this->redirectToRoute('gallery_index');
    }

    $form = $this->createForm(CategorieHorlogeType::class, $cat);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $filename = uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move($this->getParameter('uploads_directory'), $filename);
            $cat->setImage($filename);
        }

        $em->flush();
        $this->addFlash('success', 'Horloge modifiée avec succès');

        return $this->redirectToRoute('app_gallery');
    }

    return $this->render('gallery/form.html.twig', [
        'form' => $form->createView(),
        'title' => 'Modifier une horloge',
    ]);
}

}
