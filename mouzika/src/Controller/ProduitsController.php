<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Mail\MailerApi;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="app_produits_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produits::class)
            ->findAll();

        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
        ]);
    }
    /**
     * @Route("/back", name="display_Produits",)
     */
    public function indeexProduit(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produits::class)
            ->findAll();


        return $this->render('produits/indexB.html.twig', [
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/new", name="app_produits_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();
            $email = new MailerApi();
            $email->sendEmail( $mailer,'testapimail63@gmail.com','nourhene.maaouia@esprit.tn','testing email','produit ajouté avec success');

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_produits_show", methods={"GET"})
     */
    public function show(Produits $produit): Response
    {
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_produits_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produits $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_produits_delete", methods={"POST"})
     */
    public function delete(Request $request, Produits $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @param ProduitsRepository $repository
     * @param Request $request
     * @return Response
     * @Route ("/produits/recherche",name="recherche")
     */
    function Recherche(ProduitsRepository $repository, Request $request)
    {
        $data = $request->get('search');
        $produit = $repository->findBy(['id' => $data]);
        return $this->render("produits/index.html.twig", ['produits' => $produit]);
    }


    /**
     * @Route("/produits/pdf", name="imprimer_index")
     */


    public function imprimeProduit(ProduitsRepository $produitsRepository): Response

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $produit = $produitsRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('produits/pdf.html.twig', [
            'produits' => $produit,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste  produit.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @param ProduitsRepository $repository
     * @return Response
     * @Route ("/produits/ListDQL",name="tri")
     */
    function OrderByPriceDQL(ProduitsRepository $repository)
    {
        $produit = $repository->OrderByPriceDQL();
        return $this->render("produits/index.html.twig", ['produits' => $produit]);
    }

}
