<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Entity\Author;
use App\Repository\AuthorRepository;

use Doctrine\ORM\EntityManagerInterface;

#[Route('/book', requirements: ["_locale" => "en|es|fr"], name: 'app_book_')]
class BookController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $books = $entityManager->getRepository(Book::class)->findAll();
        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/fiche/{id<\d+>}', name: 'fiche')]
    public function getBook(int $id, EntityManagerInterface $entityManager): Response
    {
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException("Aucun livre avec l'id " . $id);
        }

        return $this->render('book/book-details.html.twig', [
            'book' => $book
        ]);
    }
}
