<?php

namespace App\Controller;

use App\Entity\PropretySearch;
use App\Entity\Quiz;
use App\Form\PropretySearchType;
use App\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="display_quiz")
     */
    public function index(Request $request): Response
    {
        $propretySearch=new PropretySearch();
        $form=$this->createForm(PropretySearchType::class,$propretySearch);
        $form->handleRequest($request);
        $quiz= $this->getDoctrine()->getManager()->getRepository(Quiz::class)->findAll();
        if ($form->isSubmitted()&&$form->isValid()){
            $nom=$propretySearch->getNom();
            if($nom!="")
                $quiz= $this->getDoctrine()->getManager()->getRepository(Quiz::class)->findBy(['question'=>$nom]);
            else
                $quiz= $this->getDoctrine()->getManager()->getRepository(Quiz::class)->findAll();
        }

        return $this->render('quiz/index.html.twig', [
            'form'=>$form->createView(),'q'=>$quiz
        ]);
    }
    /**
     * @Route("/addQuiz", name="addQuiz")
     */
    public function addQuiz(Request $request): Response
    {
        $quiz = new Quiz();
        $form= $this->createForm(QuizType::class,$quiz);
        $form->handleRequest($request);

        if($form->isSubmitted()&&($form->isValid())){
            $em=$this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();
            return $this->redirectToRoute('display_quiz');
        }
        return $this->render('quiz/createQuiz.html.twig',['f'=>$form->createView()]);
    }
    /**
     * @Route("/suppQuiz/{id}", name="supp_quiz")
     */
    public function suppQuiz(Quiz $quiz): Response
    {
        $em= $this->getDoctrine()->getManager();
        $em->remove($quiz);
        $em->flush();

        return $this->redirectToRoute('display_quiz');
    }

    /**
     * @Route("/modifQuiz/{id}", name="modify_quiz")
     */
    public function modifQuiz(Request $request,$id): Response
    {
        $quiz=$this->getDoctrine()->getManager()->getRepository(Quiz::class)->find($id);
        $form= $this->createForm(QuizType::class,$quiz);
        $form->handleRequest($request);

        if($form->isSubmitted()&&($form->isValid())){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('display_quiz');
        }
        return $this->render('quiz/updateQuiz.html.twig',['f'=>$form->createView()]);
    }
}
