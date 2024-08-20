<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use App\Repository\QuizRepository;

class HomePageController extends AbstractController
{
    #[Route('/homePage', name: 'homePage',methods: ["GET"])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $user = $this->getUser();

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('HomePage.html.twig', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    #[Route('/homePage', name: 'homePage', methods: ["GET"])]
    public function indexUserQuiz(CategorieRepository $categorieRepository, QuizRepository $quizRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $quizzes = $quizRepository->findAll();
        $user = $this->getUser();

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('HomePage.html.twig', [
            'user' => $user,
            'categories' => $categories,
            'quizzes' => $quizzes,
        ]);
    }
}
