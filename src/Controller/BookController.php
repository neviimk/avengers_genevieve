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

    #[Route('/recherche/{letter}', name: 'recherche_lettre')]
    public function getByLetter(string $letter, BookRepository $bookRepository): Response
    {
        $listeLivres = $bookRepository->findByFirstLetter($letter);

        return $this->render('book/index.html.twig', [
            'books' => $listeLivres,
            'title' => "Livres commençant par : " . strtoupper($letter)
        ]);
    }

    #[Route('/authors/livres/{min}', name: 'app_authors_livres')]
    public function authors(int $min, AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAuthorsWithMoreThan($min);

        return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'min' => $min
        ]);
    }

    #[Route('/stats', name: 'app_book_stats')]
    public function stats(BookRepository $bookRepository): Response
    {
        $total = $bookRepository->countAllBooks();

        return new Response("Il y a au total " . $total . " livres en base de données.");
    }
}
