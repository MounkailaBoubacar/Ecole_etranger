<?php

namespace App\Controller\Admin;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
#[Route('/admin/matiere', name: 'admin_matiere_')]
class MatiereController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('admin/matiere/index.html.twig', [
         'liste'=>$matiereRepository->findAll(),
        ]);
    }
    #[Route('/add', name: 'add')]
    public function matiereAdd(EntityManagerInterface $entityManager,Request $request)
    {
        $matiere=new matiere();

        $form=$this->createForm(MatiereType::class,$matiere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($matiere);
            $entityManager->flush();
            $this->addFlash('succes','votre matiere a bien ete ajouter');
            return $this->redirectToRoute('admin_matiere_home');
        }
        return $this->render('admin/matiere/ajout.html.twig', [
            'form' =>$form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'edit')]
    public function matiereEdit(EntityManagerInterface $entityManager,Request $request,Matiere $matiere)
    {

        $form=$this->createForm(MatiereType::class,$matiere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($matiere);
            $entityManager->flush();
            return $this->redirectToRoute('admin_matiere_home');
        }
        return $this->render('admin/matiere/ajout.html.twig', [
            'form' =>$form->createView(),
        ]);
    }


}
