<?php

namespace App\Controller;

use App\Entity\Cour;
use App\Form\CourType;
use App\Repository\CourRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cour')]
class CourController extends AbstractController
{
    #[Route('/list/{id}', name: 'app_cour_index', methods: ['GET'])]
    public function index(CourRepository $courRepository,$id): Response
    {
        return $this->render('cour/index.html.twig', [
            'cours' => $courRepository->findBy(["formation"=>$id]),
            'id'=>$id
        ]);
    }

    #[Route('/new/{id}', name: 'app_cour_new', methods: ['GET', 'POST'])]
    public function new(Request $request,$id, CourRepository $courRepository,FormationRepository $formationRepository): Response
    {
        $cour = new Cour();
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);
        $cour->setFormation($formationRepository->find($id));
        $cour->setDate(new \DateTime("now"));

        if ($form->isSubmitted() && $form->isValid()) {
            $courRepository->save($cour, true);

            return $this->redirectToRoute('app_cour_index', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cour/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cour_show', methods: ['GET'])]
    public function show(Cour $cour): Response
    {
        return $this->render('cour/contenue.html.twig', [
            'contenue' => $cour->getContenue(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cour_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cour $cour, CourRepository $courRepository): Response
    {
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courRepository->save($cour, true);

            return $this->redirectToRoute('app_cour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cour/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cour_delete', methods: ['POST'])]
    public function delete(Request $request, Cour $cour, CourRepository $courRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $courRepository->remove($cour, true);
        }

        return $this->redirectToRoute('app_cour_index', [], Response::HTTP_SEE_OTHER);
    }
}
