<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Form\AlbumsType;
use App\Repository\AlbumsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

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
            $ImageFile = $form->get('imageAlbum')->getData();
            if ($ImageFile) {

                $fileName = md5(uniqid()) . '.' . $ImageFile->guessExtension();
                try {
                    $ImageFile->move($this->getParameter('brochures_directory'), $fileName);
                } catch (FileException $e) {

                }
                $album->setImageAlbum($fileName);
            }
            //api sms
           // $sid    = "AC2574409f5bcff86a96bbb6df2b408dbd";
           // $token  = "7bee95769514a91b6d62f8499c1e0a7d";
           //// $twilio = new Client($sid, $token);

           // $message = $twilio->messages
               // ->create("+21650607032", // to
                  //  array(
                       // "messagingServiceSid" => "MG4077d806009c81b37754587f4a8b2d56",
                     //   "body" => "The album has been added to Mouzika."
                 //   )
              //  );

           // print($message->sid);
            //end sms

//SECOND SMS

            //$sid = 'AC2574409f5bcff86a96bbb6df2b408dbd';
            //$token = '7bee95769514a91b6d62f8499c1e0a7d';
            //$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
           // $client->messages->create(
            // the number you'd like to send the message to
              //  '+21650607032',
              //  [
                    // A Twilio phone number you purchased at twilio.com/console
                   // 'from' => '+14454551887',
                    // the body of the text message you'd like to send
                  //  'body' => 'Album ajouté!']
          //  );












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


            $ImageFile = $form->get('imageAlbum')->getData();
            if ($ImageFile) {

                $fileName = md5(uniqid()) . '.' . $ImageFile->guessExtension();
                try {
                    $ImageFile->move($this->getParameter('brochures_directory'), $fileName);
                } catch (FileException $e) {

                }
                $album->setImageAlbum($fileName); }


            //send email
            $message = (new \Swift_Message('Album modifié!')) //subject
                ->setFrom('malek.labidi@esprit.tn')
                ->setTo('malek.labidi@esprit.tn')
                ->setBody("The album ".$album->getTitle().  " has been modified."
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



    /**
     * @Route("/front/albums", name="albums_front", methods={"GET"})
     */
    public function front(EntityManagerInterface $entityManager): Response
    {
        $albums = $entityManager
            ->getRepository(Albums::class)
            ->findAll();
        $rock=0;
        $pop=0;
        $indie=0;
        $punk=0;
        $electro=0;
        foreach ($albums as $album)
        {
            if ($album->getGenre()=="Rock") $rock=$rock+1;
            else if ($album->getGenre()=="Pop") $pop=$pop+1;
            else if ($album->getGenre()=="Punk") $punk=$punk+1;
            else if ($album->getGenre()=="Indie") $indie=$indie+1;
            else if ($album->getGenre()=="Electro") $electro=$electro+1;
        }


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Genre', 'Nombre des albums'],
                ['Pop',     $pop],
                ['Rock',      $rock],
                ['Punk',  $punk],
                ['Indie', $indie],
                ['Electro', $electro]

            ]
        );
        $pieChart->getOptions()->setTitle('Les genres les plus produits en Tunisie');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('singlesfront/albumsfront.html.twig', [
            'albums' => $albums,
            'piechart' => $pieChart
        ]);
    }




}
