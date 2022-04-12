<?php

namespace App\Controller;

use App\Entity\Promotions;
#use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PromotionsType;


class PromotionsController extends AbstractController
{
    /**
     * @Route("/promotions", name="display_promotion")
     */
    public function index(): Response
    {
        $promotions= $this->getDoctrine()->getManager()->getRepository(Promotions::class)->findAll();
        return $this->render('promotions/index.html.twig', [
            'p'=>$promotions
        ]);
    }
    /**
     * @Route("/backoffice", name="")
     */
    public function indexAdmin(): Response
    {

        return $this->render('Admin/yo.html.twig');
    }
    /**
     * @Route("", name="display_front")
     */
    public function indexFront(): Response
    {

        return $this->render('FrontPage/index.html.twig');
    }
    /**
     * @Route("/addPromo", name="addPromotion")
     */
    public function addPromotion(Request $request): Response
    {
        $promotion = new Promotions();
        $form= $this->createForm(PromotionsType::class,$promotion);
        $form->handleRequest($request);

        if($form->isSubmitted()&&($form->isValid())){
            $em=$this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute('display_promotion');
        }
        return $this->render('promotions/createPromo.html.twig',['f'=>$form->createView()]);
    }
    /**
     * @Route("/suppPromo/{id}", name="supp_promo")
     */
    public function suppPromo(Promotions $promotions): Response
    {
        $em= $this->getDoctrine()->getManager();
        $em->remove($promotions);
        $em->flush();

        return $this->redirectToRoute('display_promotion');
    }

    /**
     * @Route("/modifPromo/{id}", name="modify_promo")
     */
    public function modifPromo(Request $request,$id): Response
    {
        $promotion=$this->getDoctrine()->getManager()->getRepository(Promotions::class)->find($id);
        $form= $this->createForm(PromotionsType::class,$promotion);
        $form->handleRequest($request);

        if($form->isSubmitted()&&($form->isValid())){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('display_promotion');
        }
        return $this->render('promotions/updatePromo.html.twig',['f'=>$form->createView()]);
    }
}
