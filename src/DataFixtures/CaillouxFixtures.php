<?php

namespace App\DataFixtures;

use App\Entity\Cailloux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CaillouxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $caillouxData = [
            
            // FAUNE
            [
                'title' => 'Cerf Rusa',
                'description' => 'Chassé par les Calédoniens, le Cerf Rusa est très consommé dans l’archipel. Il vit dans la savane et sur les terrains d’élevage.',
                'image' => 'assets/images/cerf-rusa.jpg',
                'category' => 'faune'
            ],
            [
                'title' => 'Cagou',
                'description' => 'Oiseau emblème de la Nouvelle-Calédonie. Son cri ressemble à un aboiement. Espèce menacée protégée dans les parcs.',
                'image' => 'assets/images/cagou.webp',
                'category' => 'faune'
            ],
            [
                'title' => 'Tricot rayé',
                'description' => 'Serpent marin emblématique. Venimeux mais très craintif et non agressif envers l’homme.',
                'image' => 'assets/images/tricot-raye.jpg',
                'category' => 'faune'
            ],

            // FLORE
            [
                'title' => 'Pin colonnaire',
                'description' => 'Symbole du territoire, cet arbre majestueux est indissociable des paysages de l’Île des Pins.',
                'image' => 'assets/images/pin-colonnaire.webp',
                'category' => 'flore'
            ],
            [
                'title' => 'Niaouli',
                'description' => 'Arbre résistant au feu, utilisé pour la construction des cases et réputé pour ses vertus médicinales.',
                'image' => 'assets/images/niaouli.jpg',
                'category' => 'flore'
            ],
            [
                'title' => 'Fougère arborescente',
                'description' => 'L’une des plus grandes au monde, elle peut atteindre 35m de haut dans les forêts humides.',
                'image' => 'assets/images/fougere-arborescente.jpeg',
                'category' => 'flore'
            ],
        ];

        foreach ($caillouxData as $data) {
            $caillou = new Cailloux();
            $caillou->setTitle($data['title']);
            $caillou->setDescription($data['description']);
            $caillou->setImageUrl($data['image']);
            $caillou->setCategory($data['category']);
            
            $manager->persist($caillou);
        }

        $manager->flush();
    }
}