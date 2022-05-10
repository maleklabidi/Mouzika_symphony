<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Mail\MailerApi;
use App\Repository\ArticleRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $articles = $entityManager
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/back", name="app_article_back", methods={"GET"})
     */
    public function indexB(EntityManagerInterface $entityManager): Response
    {
        $articles = $entityManager
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('article/indexB.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @param ArticleRepository $articleRepository
     * @return Response
     * @Route ("/stat",name="stat")
     */
    public function stat(ArticleRepository $articleRepository)
    {

        $nbs = $articleRepository->countEtat();
        $data = [['rate', 'Article']];
        foreach( (array)$nbs as $nb)
        {
            $data[] = array($nb['e'], $nb['tran']);
        }
        $bar = new barchart();
        $bar->getData()->setArrayToDataTable(
            $data
        );

        $bar->getOptions()->setTitle('Nombres des Etoiles:');
        $bar->getOptions()->setHeight(500);
        $bar->getOptions()->setWidth(900);
        $bar->getOptions()->getTitleTextStyle()->setColor('#1E90FF');
        $bar->getOptions()->getTitleTextStyle()->setFontSize(25);





        return $this->render('article/stat.html.twig', array('barchart' => $bar,'nbs' => $nbs));
    }


    /**
     * @Route("/new", name="app_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }



    /**
     * @Route("/article/pdf", name="imprimer_index")
     */


    public function imprimeArticle(ArticleRepository $articleRepository): Response

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $article = $articleRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('article/pdf.html.twig', [
            'articles' => $article,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste  article.pdf", [
            "Attachment" => true
        ]);
    }




    /**
     * @param ArticleRepository $repository
     * @return Response
     * @Route ("/article/ListDQL",name="tri")
     */
    function OrderByPriceDQL(ArticleRepository $repository)
    {
        $article = $repository->OrderByPriceDQL();
        return $this->render("article/index.html.twig", ['articles' => $article]);
    }

    /**
     * @param ArticleRepository $repository
     * @param Request $request
     * @return Response
     * @Route ("/article/recherche",name="recherche")
     */
    function Recherche(ArticleRepository $repository, Request $request)
    {
        $data = $request->get('search');
        $article = $repository->findBy(['id' => $data]);
        return $this->render("article/index.html.twig", ['articles' => $article]);
    }

}
