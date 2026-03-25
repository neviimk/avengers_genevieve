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
}
