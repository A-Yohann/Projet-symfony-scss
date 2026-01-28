<?php

namespace App\Controller;

use App\Entity\CategorieHorloge;
use App\Entity\Comment;
use App\Repository\CategorieHorlogeRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/horloge/{id}', name: 'app_horloge_show', methods: ['GET', 'POST'])]
    public function show(CategorieHorloge $horloge, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Traiter le formulaire de commentaire si soumis
        if ($request->isMethod('POST')) {
            $author = $request->request->get('author');
            $content = $request->request->get('content');
            
            if ($author && $content) {
                $comment = new Comment();
                $comment->setAuthor($author);
                $comment->setContent($content);
                $comment->setCategorieHorloge($horloge);
                
                $entityManager->persist($comment);
                $entityManager->flush();
                
                $this->addFlash('success', 'Commentaire ajouté avec succès !');
                
                return $this->redirectToRoute('app_horloge_show', ['id' => $horloge->getId()]);
            }
        }
        
        return $this->render('horloge/show.html.twig', [
            'horloge' => $horloge,
        ]);
    }
}