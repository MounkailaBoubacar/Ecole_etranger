<?php

namespace App\Controller\Admin;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Repository\EvaluationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
#[Route('/admin/evaluation', name: 'admin_evaluation_')]
class EvaluationController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EvaluationRepository $evaluationRepository): Response
    {
        return $this->render('admin/evaluation/index.html.twig', [
         'liste'=>$evaluationRepository->findAll(),
        ]);
    }
    #[Route('/add', name: 'add')]
    public function evaluationAdd(EntityManagerInterface $entityManager,Request $request)
    {
        $evaluation=new evaluation();

        $form=$this->createForm(EvaluationType::class,$evaluation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($evaluation);
            $entityManager->flush();
            $this->addFlash('succes','votre evaluation a bien ete ajouter');
            return $this->redirectToRoute('admin_evaluation_home');
        }
        return $this->render('admin/evaluation/ajout.html.twig', [
            'form' =>$form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'edit')]
    public function evaluationEdit(EntityManagerInterface $entityManager,Request $request,Evaluation $evaluation)
    {

        $form=$this->createForm(EvaluationType::class,$evaluation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($evaluation);
            $entityManager->flush();
            return $this->redirectToRoute('admin_evaluation_home');
        }
        return $this->render('admin/evaluation/ajout.html.twig', [
            'form' =>$form->createView(),
        ]);
    }


}
