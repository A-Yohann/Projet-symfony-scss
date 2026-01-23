<?php

namespace App\Controller;

use App\Entity\CategorieHorloge;
use App\Form\CategorieHorlogeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AddHorlogeController extends AbstractController
{
    #[Route('/gallery/new', name: 'categorie_horloge_new')]
public function create(Request $request, EntityManagerInterface $em): Response
{
    $this->denyAccessUnlessGranted('ROLE_USER');

    $cat = new CategorieHorloge();
    $form = $this->createForm(CategorieHorlogeType::class, $cat);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $cat->setUser($this->getUser());

        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $filename = uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move($this->getParameter('uploads_directory'), $filename);
            $cat->setImage($filename);
        }

        $em->persist($cat);
        $em->flush();

        $this->addFlash('success', 'Horloge ajoutée avec succès');

        return $this->redirectToRoute('app_gallery');
    }

    return $this->render('gallery/form.html.twig', [
        'form' => $form->createView(),
        'title' => 'Ajouter une horloge',
    ]);
}

}
