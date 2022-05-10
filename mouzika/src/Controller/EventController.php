<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Participation;
use App\Form\EventType;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{

    /**
     * @Route("/pdf/", name="pdf")
     */
    public function pdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository(Event::class)->findAll();
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('event/pdf.html.twig', [
            'events' => $evenement
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("pdf.pdf", [
            "Attachment" => true
        ]);

    }





    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $events = $entityManager
            ->getRepository(Event::class)
            ->findAll();

        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }


    /**
     * @Route("/front", name="event_front", methods={"GET"})
     */
    public function front(EntityManagerInterface $entityManager): Response
    {
        $events = $entityManager
            ->getRepository(Event::class)
            ->findAll();

        return $this->render('event/eventfront.html.twig', [
            'events' => $events,
        ]);
    }


    /**
     * @Route("/details/{id}", name="details_front", methods={"GET"})
     */
    public function details(EntityManagerInterface $entityManager,$id): Response
    {
        $events = $entityManager
            ->getRepository(Event::class)
            ->find($id);

        return $this->render('event/detailsEvent.html.twig', [
            'event' => $events,
        ]);
    }



    /**
     * @Route("/new", name="event_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idevent}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{idevent}/edit", name="event_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/delete/{id}", name="event_delete")
     */
    public function delete($id, \Swift_Mailer $mailer)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository(Event::class)->find($id);

        $particiapation = $em->getRepository(Participation::class)->findBy(array('ideventparticipation'=>$evenement));

        foreach ($particiapation as $p){

            $message = (new \Swift_Message('Evenement Supprimer'))
                ->setFrom('khaled.rania@esprit.tn')
                ->setTo("khaled.rania@esprit.tn")
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'event/email.html.twig',
                        ['participation' => $p]
                    ),
                    'text/html'
                )

                // you can remove the following code if you don't define a text version for your emails
                ->addPart(
                    $this->renderView(
                    // templates/emails/registration.txt.twig
                        'event/email.html.twig',
                        ['participation' => $p]
                    ),
                    'text/plain'
                )
            ;

            $mailer->send($message);


        }
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('event_index');
    }




}
