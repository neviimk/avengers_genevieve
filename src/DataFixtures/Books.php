<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Keyword;

class Books extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $booksData = [
            [
                'author' => 'Antoine de Saint-Exupéry',
                'title' => 'Le Petit Prince',
                'description' => "C'est l'histoire d'un pilote échoué dans le désert rencontrant un enfant venu d'une autre planète. Il y décrit ses voyages vers diverses planètes, ses rencontres avec des personnages singuliers, et ses réflexions sur l'amour et l'amitié avant son retour symbolique à son astéroïde."
            ],
            [
                'author' => 'Agatha Christie',
                'title' => 'Ils étaient dix',
                'description' => "Dans ce roman, dix personnes apparemment sans lien entre elles sont invitées à se rendre sur une île. Bien qu'elles soient seules à se trouver sur ce lieu, elles sont assassinées l'une après l'autre, à chaque fois d'une façon qui rappelle les couplets d'une comptine."
            ],
            [
                'author' => 'Victor Hugo',
                'title' => 'Les Misérables',
                'description' => "Les Misérables raconte la vie de Jean Valjean, ancien forçat en quête de rédemption, dans une France marquée par la pauvreté, la révolution, l'injustice sociale et l'espoir."
            ],
        ];
        foreach ($booksData as $data) {
            $author = new Author();
            $author->setName($data['author']);
            $manager->persist($author);

            $book = new Book();
            $book->setTitle($data['title']);
            $book->setDescription($data['description']);
            $book->setAuthor($author);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
