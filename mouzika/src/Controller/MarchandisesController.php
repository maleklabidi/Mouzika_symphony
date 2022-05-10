<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarchandisesController extends AbstractController
{
    /**
     * @Route("/marchandises", name="marchandises")
     */
    public function index(): Response
    {
        return $this->render('marchandises/index.html.twig', [
            'controller_name' => 'MarchandisesController',
        ]);
    }
    /**
     * @Route("/ajouter", name="ajouter_marchandises")
     */
    public function ajouter(): Response
    {
        return $this->render('marchandises/ajouter.html.twig', [
            'controller_name' => 'MarchandisesController',
        ]);;
    }
    /**
     * @Route("/consultermarch", name="consulter_marchandises")
     */
    public function consultermarchandises(): Response
    {
        return $this->render('marchandises/consultermarch.html.twig', [
            'controller_name' => 'MarchandisesController',
        ]);;
    }
    /**
     * @Route("/connexion", name="home")
     */
    public function home(): Response
    {
        return $this->render('marchandises/home.html.twig', [
            'controller_name' => 'MarchandisesController',
        ]);;
    }
    /**
     * @Route("/front", name="home_front")
     */
    public function home_front(): Response
    {
        return $this->render('/Front-template/home-front.html.twig', [
            'controller_name' => 'MarchandisesController',
        ]);;
    }

}
