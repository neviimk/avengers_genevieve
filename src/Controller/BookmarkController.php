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
            'BookmarkController' => 'BookmarkController',
        ]);
    }
}
