<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('index/homepage.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        $authorsNames = [
            "Barry Francis",
            "Hannah Ballard",
            "Ralph Waters",
            "Barbara Figueroa"
        ];

        return $this->render('index/about.html.twig', [
            'authors' => $authorsNames
        ]);
    }
}
