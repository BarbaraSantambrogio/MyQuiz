<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategorieRepository;
use Symfony\Bundle\SecurityBundle;

class HomeController extends AbstractController
{
    #[Route("/", name: "home.index", methods: ["GET"])]
    public function index(CategorieRepository $categorieRepository): Response {
        $categorie = $categorieRepository->findAll();

        return $this->render('home.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route("/", name: "quiz.index", methods: ["GET"])]
    public function indexQuiz(CategorieRepository $categorieRepository): Response {
        $categorie = $categorieRepository->findAll();

        return $this->render('quiz.html.twig', [
            'categories' => $categorie
        ]);
    }
}
