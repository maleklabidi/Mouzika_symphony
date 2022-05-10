<?php

namespace App\Controller;

use App\Entity\Titres;
use App\Form\TitresType;
use App\Repository\TitresRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/titres")
 */
class TitresController extends AbstractController
{
    /**
     * @Route("/", name="app_titres_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $titres = $entityManager
            ->getRepository(Titres::class)
            ->findAll();

        return $this->render('titres/index.html.twig', [
            'titres' => $titres,
        ]);
    }
    /**
     * @Route("/titreBack", name="app_titres_indexBack", methods={"GET"})
     */
    public function indexb(EntityManagerInterface $entityManager, TitresRepository $titresRepository): Response
    {
        $titres = $entityManager
            ->getRepository(Titres::class)
            ->findAll();
        $list1=$titresRepository->calcul(1);
        $total1=0;
        foreach ($list1 as $row){
            $total1++;
        }
        $list2=$titresRepository->calcul(2);
        $total2=0;
        foreach ($list2 as $row){
            $total2++;
        }
        $list3=$titresRepository->calcul(3);
        $total3=0;
        foreach ($list3 as $row){
            $total3++;
        }
        $list4=$titresRepository->calcul(4);
        $total4=0;
        foreach ($list4 as $row){
            $total4++;
        }
        $list5=$titresRepository->calcul(4);
        $total5=0;
        foreach ($list5 as $row){
            $total5++;
        }
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['1',     $total1],
                ['2',    $total2],
                ['3',    $total3],
                ['4',    $total4],
                ['5',    $total5]
            ]
        );
        $pieChart->getOptions()->setTitle('Rating activities');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('titres/indexb.html.twig', [
            'titres' => $titres,
            'piechart' => $pieChart,

        ]);
    }

    /**
     * @Route("/new", name="app_titres_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $titre = new Titres();
        $form = $this->createForm(TitresType::class, $titre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($titre);
            $entityManager->flush();

            return $this->redirectToRoute('app_titres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('titres/new.html.twig', [
            'titre' => $titre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_titres_show", methods={"GET"})
     */
    public function show(Titres $titre): Response
    {
        return $this->render('titres/show.html.twig', [
            'titre' => $titre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_titres_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Titres $titre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TitresType::class, $titre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_titres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('titres/edit.html.twig', [
            'titre' => $titre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_titres_delete", methods={"POST"})
     */
    public function delete(Request $request, Titres $titre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$titre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($titre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_titres_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @param TitresRepository $repository
     * @param Request $request
     * @return Response
     * @Route ("/titres/recherche",name="recherchet")
     */
    function Recherche(TitresRepository $repository, Request $request)
    {
        $data = $request->get('search');
        $titre = $repository->findBy(['id' => $data]);
        return $this->render("titres/index.html.twig", ['titres' => $titre]);
    }

}
