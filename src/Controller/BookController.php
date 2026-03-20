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

    #[Route('/add', name: 'book_add')]
    public function ajouterBook(EntityManagerInterface $entityManager): Response
    {
        // LE PETIT PRINCE - SAINT-EXUPÉRY
        $a1 = new Author();
        $a1->setName("Antoine de Saint-Exupéry");

        $book1 = new Book();
        $book1->setTitle("Le Petit Prince");
        $book1->setDescription("C'est l'histoire d'un pilote échoué dans le désert rencontrant un enfant venu d'une autre planète. Il y décrit ses voyages vers diverses planètes, ses rencontres avec des personnages singuliers, et ses réflexions sur l'amour et l'amitié avant son retour symbolique à son astéroïde.");
        $book1->setAuthor($a1);

        // ILS ÉTAIENT DIX - AGATHA CHRISTIE
        $a2 = new Author();
        $a2->setName("Agatha Christie");

        $book2 = new Book();
        $book2->setTitle("Ils étaient dix");
        $book2->setDescription("Dans ce roman, dix personnes apparemment sans lien entre elles sont invitées à se rendre sur une île. Bien qu'elles soient seules à se trouver sur ce lieu, elles sont assassinées l'une après l'autre, à chaque fois d'une façon qui rappelle les couplets d'une comptine");
        $book2->setAuthor($a2);

        // LES MISÉRABLES - VICTOR HUGO
        $a3 = new Author();
        $a3->setName("Victor Hugo");

        $book3 = new Book();
        $book3->setTitle("Les Misérables");
        $book3->setDescription("Les Misérables raconte la vie de Jean Valjean, ancien forçat en quête de rédemption, dans une France marquée par la pauvreté, la révolution, l'injustice sociale et l'espoir.");
        $book3->setAuthor($a3);

        // PERSIST DES DONNÉES AJOUTÉES
        $entityManager->persist($a1);
        $entityManager->persist($a2);
        $entityManager->persist($a3);

        $entityManager->persist($book1);
        $entityManager->persist($book2);
        $entityManager->persist($book3);

        $entityManager->flush();

        return new Response("Trois livres ont été ajoutés avec succès !");
    }
}
