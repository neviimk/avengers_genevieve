<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Bookmark;
use App\Entity\Keyword;

class Bookmarks extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $keywordsObjects = [];
        $tags = [
            'PHP', 'Symfony', 'Web', 'Framework', 'OpenSource', 'Backend', 'Frontend', 
            'Database', 'Docker', 'Git', 'GitHub', 'Security', 'Cloud', 'API', 'DevOps', 
            'Tutorial', 'News', 'Social', 'Search', 'Design', 'UX', 'UI', 'Mobile', 'JS', 'CSS'
        ];

        foreach ($tags as $tagName) {
            $kw = new Keyword();
            $kw->setName($tagName);
            $manager->persist($kw);
            $keywordsObjects[] = $kw;
        }

        $sites = [
            ['url' => 'https://symfony.com', 'comment' => 'Site officiel de Symfony'],
            ['url' => 'https://github.com', 'comment' => 'Hébergement de code'],
        ];

        foreach ($sites as $siteData) {
            $bm = new Bookmark();
            $bm->setUrl($siteData['url']);
            $bm->setCommentaire($siteData['comment']);
            $bm->setDateCreation(new \DateTime());

            shuffle($keywordsObjects);
            
            $nbKeywords = mt_rand(2, 5);
            
            for ($i = 0; $i < $nbKeywords; $i++) {
                $bm->addKeyword($keywordsObjects[$i]);
            }

            $manager->persist($bm);
        }

        $manager->flush();
    }
}
