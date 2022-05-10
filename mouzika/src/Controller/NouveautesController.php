<?php

namespace App\Controller;

use App\Entity\Nouveautes;
use App\Form\NouveautesType;
use App\Repository\NouveautesRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nouveautes")
 */
class NouveautesController extends AbstractController
{
    /**
     * @Route("/", name="app_nouveautes_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $nouveautes = $entityManager
            ->getRepository(Nouveautes::class)
            ->findAll();

        return $this->render('nouveautes/index.html.twig', [
            'nouveautes' => $nouveautes,
        ]);
    }

    /**
     * @Route("/nouv", name="app_nouveautes_indexBack", methods={"GET"})
     */
    public function indexF(EntityManagerInterface $entityManager,NouveautesRepository $nouveautesRepository): Response
    {
        $nouveautes = $entityManager
            ->getRepository(Nouveautes::class)
            ->findAll();
        $list1=$nouveautesRepository->calcul(1);
        $total1=0;
        foreach ($list1 as $row){
            $total1++;
        }
        $list2=$nouveautesRepository->calcul(2);
        $total2=0;
        foreach ($list2 as $row){
            $total2++;
        }
        $list3=$nouveautesRepository->calcul(3);
        $total3=0;
        foreach ($list3 as $row){
            $total3++;
        }
        $list4=$nouveautesRepository->calcul(4);
        $total4=0;
        foreach ($list4 as $row){
            $total4++;
        }
        $list5=$nouveautesRepository->calcul(4);
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

        return $this->render('nouveautes/indexBack.html.twig', [
            'nouveautes' => $nouveautes,
            'piechart' => $pieChart,

        ]);
    }

    /**
     * @Route("/new", name="app_nouveautes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nouveaute = new Nouveautes();
        $form = $this->createForm(NouveautesType::class, $nouveaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nouveaute);
            $entityManager->flush();

            return $this->redirectToRoute('app_nouveautes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nouveautes/new.html.twig', [
            'nouveaute' => $nouveaute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_nouveautes_show", methods={"GET"})
     */
    public function show(Nouveautes $nouveaute): Response
    {
        return $this->render('nouveautes/show.html.twig', [
            'nouveaute' => $nouveaute,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_nouveautes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Nouveautes $nouveaute, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NouveautesType::class, $nouveaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_nouveautes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nouveautes/edit.html.twig', [
            'nouveaute' => $nouveaute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_nouveautes_delete", methods={"POST"})
     */
    public function delete(Request $request, Nouveautes $nouveaute, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nouveaute->getId(), $request->request->get('_token'))) {
            $entityManager->remove($nouveaute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nouveautes_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @param NouveautesRepository $repository
     * @param Request $request
     * @return Response
     * @Route ("/nouveautes/recherche",name="recherchen")
     */
    function Recherche(NouveautesRepository $repository, Request $request)
    {
        $data = $request->get('search');
        $nouveau = $repository->findBy(['id' => $data]);
        return $this->render("nouveautes/index.html.twig", ['nouveautes' => $nouveau]);
    }

}
