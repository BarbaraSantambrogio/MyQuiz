<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\QuestionRepository;
use App\Repository\CategorieRepository;
use App\Repository\ReponseRepository;
use App\Form\QuizFormType;
use App\Entity\Quiz;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Question;    
use App\Entity\Reponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle;


class QuizController extends AbstractController
{
    #[Route('/quiz/{id}', name: 'quiz', requirements:['id' => '\d+'])]

    
    public function showQuestion(QuestionRepository $questionRepository, int $id,  ReponseRepository $reponseRepository): Response
    {
        $questions = $questionRepository->findAllWithCategorie($id);
        $reponses = $reponseRepository->findByQuestion($id);
        $arr = [];
        foreach($questions as $question){
            $reponses = $reponseRepository->findByQuestion($question->getId());
                   array_push($arr, [$question->getQuestion(), $reponses]);
        }
        return $this->render('quiz.html.twig', [
            
            'reponses' => $arr,
        ]);
    }

    #[Route('/quiz/create', name: 'create_quiz')]
     public function create(Request $request, EntityManagerInterface $entityManager):Response
     {
       $quiz = new Quiz();
       $form = $this->createForm(QuizFormType::class, $quiz);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($quiz);
        $entityManager->flush();
    
        return $this->redirectToRoute('homePage');

       }
       
       return $this->render('createQuiz.html.twig', [
        'form' => $form->createView()
       ]);
     }


}

