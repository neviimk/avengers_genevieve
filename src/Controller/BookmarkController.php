<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Bookmark;
use App\Repository\BookmarkRepository;
use App\Entity\Keyword;
use App\Repository\KeywordRepository;

use Doctrine\ORM\EntityManagerInterface;

#[Route('/bookmark', requirements: ["_locale" => "en|es|fr"], name: 'app_bookmark_')]
class BookmarkController extends AbstractController
{
    #[Route('', name: 'index')]
    public function fct(EntityManagerInterface $entityManager): Response
    {
        $bookmarks = $entityManager->getRepository(Bookmark::class)->findAll();
        
        return $this->render('bookmark/index.html.twig', [
            'BookmarkController' => $bookmarks,
        ]);
    }

    #[Route('/fiche/{id<\d+>}', name: 'fiche')]
    public function getBookmark(int $id, EntityManagerInterface $entityManager): Response
    {
        $bookmark = $entityManager->getRepository(Bookmark::class)->find($id);

        if (!$bookmark) {
            throw $this->createNotFoundException("Aucun bookmark avec l'id " . $id);
        }

        return $this->render('bookmark/bookmark.html.twig', [
            'bookmark' => $bookmark
        ]);
    }


    #[Route("/add", name: "bookmark_add")]
    public function ajouterBookmark(EntityManagerInterface $entityManager): Response
    {
        // SYMFONY
        $b1 = new Bookmark();
        $b1->setUrl("https://symfony.com");
        $b1->setCommentaire("Site officiel du framework PHP Symfony");
        $b1->setDateCreation(new \DateTime());
        
        // Mots-clés pour Symfony
        $symfo1 = new Keyword();
        $symfo1->setName("PHP");

        $symfo2 = new Keyword();
        $symfo2->setName("Framework");

        $symfo3 = new Keyword();
        $symfo3->setName("Web");

        $b1->addKeyword($symfo1);
        $b1->addKeyword($symfo2);
        $b1->addKeyword($symfo3);
        
        // QWANT
        $b2 = new Bookmark();
        $b2->setUrl("https://www.qwant.com");
        $b2->setCommentaire("Moteur de recherche");
        $b2->setDateCreation(new \DateTime());

        // Mots-clés pour Qwant
        $qwant1 = new Keyword();
        $qwant1->setName("Recherche");

        $qwant2 = new Keyword();
        $qwant2->setName("Securite");

        $b2->addKeyword($qwant1);
        $b2->addKeyword($qwant2);
        $b2->addKeyword($symfo3);

        // GITHUB
        $b3 = new Bookmark();
        $b3->setUrl("https://github.com");
        $b3->setCommentaire("Plateforme de versioning");
        $b3->setDateCreation(new \DateTime());

        // Mots-clés pour Github
        $github1 = new Keyword();
        $github1->setName("Git");

        $github2 = new Keyword();
        $github2->setName("Versioning");

        $github3 = new Keyword();
        $github3->setName("Repot");

        $b3->addKeyword($github1);
        $b3->addKeyword($github2);
        $b3->addKeyword($symfo3);

        $entityManager->persist($symfo1);
        $entityManager->persist($symfo2);
        $entityManager->persist($symfo3);
        $entityManager->persist($qwant1);
        $entityManager->persist($qwant2);
        $entityManager->persist($github1);
        $entityManager->persist($github2);
        $entityManager->persist($github3);

        $entityManager->persist($b1);
        $entityManager->persist($b2);
        $entityManager->persist($b3);

        $entityManager->flush();

        // return new Response("Trois marque-pages ont été ajoutés avec succès !");
        return new Response("Trois marque-pages ont été modifiés avec succès !");
    }
}
