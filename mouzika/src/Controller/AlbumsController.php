<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Form\AlbumsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;

/**
 * @Route("/albums")
 */
class AlbumsController extends AbstractController
{
    /**
     * @Route("/", name="app_albums_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $albums = $entityManager
            ->getRepository(Albums::class)
            ->findAll();

        return $this->render('albums/index.html.twig', [
            'albums' => $albums,
        ]);
    }

    /**
     * @Route("/new", name="app_albums_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $album = new Albums();
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //api sms
            $sid    = "AC5e8981d131fc7da51b1fdaa8578d91a4";
            $token  = "9edb4bc6c186b92088df3e3ae046bb22";
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create("+21650607032", // to
                    array(
                        "messagingServiceSid" => "MG4077d806009c81b37754587f4a8b2d56",
                        "body" => "The album "+$album->getTitle()+" has been added to Mouzika."
                    )
                );

            print($message->sid);
            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('app_albums_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('albums/new.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_albums_show", methods={"GET"})
     */
    public function show(Albums $album): Response
    {
        return $this->render('albums/show.html.twig', [
            'album' => $album,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_albums_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Albums $album, EntityManagerInterface $entityManager, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //send email
            $message = (new \Swift_Message('Hello Email')) //subject
                ->setFrom('malek.labidi@esprit.tn')
                ->setTo('malek.labidi@esprit.tn')
                ->setBody("The album "+$album->getTitle()+" has been modified."
                ) ;

            $mailer->send($message);

            $entityManager->flush();

            return $this->redirectToRoute('app_albums_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('albums/edit.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_albums_delete", methods={"POST"})
     */
    public function delete(Request $request, Albums $album, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $entityManager->remove($album);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_albums_index', [], Response::HTTP_SEE_OTHER);
    }
}
