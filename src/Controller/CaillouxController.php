<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Cailloux;
use App\Repository\CaillouxRepository;

use Doctrine\ORM\EntityManagerInterface;

#[Route('/cailloux', name: 'app_cailloux_')]
class CaillouxController extends AbstractController
{
    #[Route('/faune', name: 'faune')]
    public function faune(EntityManagerInterface $entityManager): Response
    {
        $cailloux = $entityManager->getRepository(Cailloux::class)->findBy(['category' => 'faune']);
        return $this->render('cailloux/index.html.twig', [
            'title' => 'Faune',
            'cailloux' => $cailloux
        ]);
    }

    #[Route('/flore', name: 'flore')]
    public function flore(EntityManagerInterface $entityManager): Response
    {
        $cailloux = $entityManager->getRepository(Cailloux::class)->findBy(['category' => 'flore']);
        return $this->render('cailloux/index.html.twig', [
            'title' => 'Flore',
            'cailloux' => $cailloux
        ]);
    }

    #[Route('/add', name: 'cailloux_add')]
    public function addSeeds(EntityManagerInterface $entityManager): Response
    {
        $data = [
            ['Cerf Rusa',
            'Chassé par les Calédoniens, le Cerf Rusa est très consommé dans l’archipel. Il vit dans la savane et sur les terrains d’élevage.',
            'assets/images/cerf-rusa.jpg',
            'faune'],
            ['Cagou ',
            'Cet oiseau est considéré comme l’emblème de la Nouvelle-Calédonie. Son cri « kagu » ressemble à l’aboiement d’un chien. Il est considéré comme une espèce menacée. On peut en apercevoir dans le sud de la Grande Terre au parc de la Rivière Bleu ou encore au parc forestier de Nouméa.',
            'assets/images/cagou.webp',
            'faune'],
            ['Gecko ',
            'Cet animal nocturne appelé aussi margouillat, est une espèce assez répandue dans le monde. Le gecko géant peut atteindre jusqu’à 40 cm de long.',
            'assets/images/gecko.webp',
            'faune'],
            ['Tricot rayé',
            'Ce serpent marin est l’espèce la plus répandue de Nouvelle-Calédonie. Venimeux, son venin est plus puissant que celui d’un cobra ! Mais de nature craintive, il n’est pas agressif et n’attaque pas.',
            'assets/images/tricot-raye.jpg',
            'faune'],
            ['Pin colonnaire',
            'Cet arbre est le symbole du territoire. On trouve notamment sur l’île des Pins.',
            'assets/images/pin-colonnaire.webp',
            'flore'],
            ['Niaouli',
            'Les kanak se servent du niaouli pour la construction des cases mais aussi pour se soigner. C’est l’arbre typique de la savane de la côte Ouest et du Nord de la Grande Terre. Grâce à sa résistance au feu, il occupe près de la moitié du territoire.',
            'assets/images/niaouli.jpg',
            'flore'],
            ['Fougère arborescente',
            'La fougère arborescente est l’une des plus grandes au monde. Présente dans les forêts humides, elle peut mesurer jusqu’à 35 m de hauteur. Vous pourrez en admirer au parc des Grandes Fougères à Sarraméa.',
            'assets/images/fougere-arborescente.jpeg',
            'flore'],
        ];

        foreach ($data as $item) {
            $p = new Cailloux();
            $p->setTitle($item[0])->setDescription($item[1])->setImageUrl($item[2])->setCategory($item[3]);
            $entityManager->persist($p);
        }
        $entityManager->flush();
        return new Response("Cailloux créés !");
    }
}
