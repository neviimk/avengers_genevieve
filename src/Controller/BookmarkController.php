<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Bookmark;
use App\Repository\BookmarkRepository;

use Doctrine\ORM\EntityManagerInterface;

class BookmarkController extends AbstractController
{
    #[Route('/bookmark', name: 'app_bookmark')]
    public function fct(EntityManagerInterface $entityManager): Response
    {
        $bookmarks = $entityManager->getRepository(Bookmark::class)->findAll();
        
        return $this->render('bookmark/index.html.twig', [
            'BookmarkController' => $bookmarks,
        ]);
    }

    #[Route("/bookmark/add", name: "bookmark_add")]
    public function ajouterBookmark(EntityManagerInterface $entityManager): Response
    {
        $b1 = new Bookmark();
        $b1->setUrl("https://symfony.com");
        $b1->setCommentaire("Site officiel du framework PHP Symfony");
        $b1->setDateCreation(new \DateTime());
        
        $b2 = new Bookmark();
        $b2->setUrl("https://www.qwant.com");
        $b2->setCommentaire("Moteur de recherche");
        $b2->setDateCreation(new \DateTime());

        $b3 = new Bookmark();
        $b3->setUrl("https://github.com");
        $b3->setCommentaire("Plateforme de versioning");
        $b3->setDateCreation(new \DateTime());

        $entityManager->persist($b1);
        $entityManager->persist($b2);
        $entityManager->persist($b3);

        $entityManager->flush();

        return new Response("Trois marque-pages ont été ajoutés avec succès !");
    }
}
