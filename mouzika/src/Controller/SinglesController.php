<?php

namespace App\Controller;

use App\data\searchData;
use App\Entity\Singles;
use App\Form\SearchSinglesFormType;
use App\Form\SinglesType;
use App\Repository\SinglesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/singles")
 */
class SinglesController extends AbstractController
{
    /**
     * @Route("/", name="app_singles_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $singles = $entityManager
            ->getRepository(Singles::class)
            ->findAll();

        return $this->render('singles/index.html.twig', [
            'singles' => $singles,
        ]);
    }

    /**
     * @Route("/new", name="app_singles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $single = new Singles();
        $form = $this->createForm(SinglesType::class, $single);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ImageFile = $form->get('imageSingle')->getData();
            if ($ImageFile) {

                $fileName = md5(uniqid()) . '.' . $ImageFile->guessExtension();
                try {
                    $ImageFile->move($this->getParameter('brochures_directory'), $fileName);
                } catch (FileException $e) {

                }
                $single->setImageSingle($fileName);
            }





            $entityManager->persist($single);
            $entityManager->flush();

            return $this->redirectToRoute('app_singles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('singles/new.html.twig', [
            'single' => $single,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_singles_show", methods={"GET"})
     */
    public function show(Singles $single): Response
    {
        return $this->render('singles/show.html.twig', [
            'single' => $single,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_singles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Singles $single, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SinglesType::class, $single);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ImageFile = $form->get('imageSingle')->getData();
            if ($ImageFile) {

                $fileName = md5(uniqid()) . '.' . $ImageFile->guessExtension();
                try {
                    $ImageFile->move($this->getParameter('brochures_directory'), $fileName);
                } catch (FileException $e) {

                }
                $single->setImageSingle($fileName); }


            $entityManager->flush();

            return $this->redirectToRoute('app_singles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('singles/edit.html.twig', [
            'single' => $single,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_singles_delete", methods={"POST"})
     */
    public function delete(Request $request, Singles $single, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$single->getId(), $request->request->get('_token'))) {
            $entityManager->remove($single);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_singles_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/front/singles", name="singles_front", methods={"GET"})
     */
    public function front(EntityManagerInterface $entityManager, SinglesRepository $repo, Request $request): Response
    {
        $data = new searchData();
        $form = $this->createForm(SearchSinglesFormType::class, $data);
        $form->handleRequest($request);
        $singles = $repo->findSearch($data);

        return $this->render('singlesfront/singlesfront.html.twig', [
            'singles' => $singles, 'form' => $form->createView() ]);
    }
}
