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
}
