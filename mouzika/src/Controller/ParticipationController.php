<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Participation;
use App\Entity\User;
use App\Form\ParticipationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participation")
 */
class ParticipationController extends AbstractController
{
    /**
     * @Route("/", name="participation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $participations = $entityManager
            ->getRepository(Participation::class)
            ->findAll();

        return $this->render('participation/index.html.twig', [
            'participations' => $participations,
        ]);
    }


    /**
     * @Route("/mesparticiapation", name="participation_mes", methods={"GET"})
     */
    public function mesParticipation(EntityManagerInterface $entityManager): Response
    {


        $user = $entityManager
            ->getRepository(User::class)
            ->find(1);

        $participations = $entityManager
            ->getRepository(Participation::class)
            ->findBy(array('id'=>$user));



        return $this->render('participation/mesEvenement.html.twig', [
            'participations' => $participations,
        ]);
    }

    /**
     * @Route("/new/{ide}", name="participation_new", methods={"GET", "POST"})
     */
    public function new($ide, EntityManagerInterface $entityManager): Response
    {

            $participation = new Participation();

            $events = $entityManager
            ->getRepository(Event::class)
            ->find($ide);

            $user = $entityManager
            ->getRepository(User::class)
            ->find(1); /// $this->>getUser();
            $participation->setIdauditeur($user);
            $participation->setIdeventparticipation($events);
            $entityManager->persist($participation);
            $entityManager->flush();
           return $this->redirectToRoute('details_front', ['id'=>$ide], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/{idparticipation}", name="participation_show", methods={"GET"})
     */
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,
        ]);
    }

    /**
     * @Route("/{idparticipation}/edit", name="participation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deletep/{id}", name="quitter")
     */
    public function delete($id)
    {

        $em = $this->getDoctrine()->getManager();
        $par = $em->getRepository(Participation::class)->find($id);
        $em->remove($par);
        $em->flush();
        return $this->redirectToRoute('participation_mes');
    }
}
