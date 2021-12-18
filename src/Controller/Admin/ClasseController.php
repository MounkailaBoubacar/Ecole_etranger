<?php

namespace App\Controller\Admin;

use App\Entity\Classe;
use App\Entity\Evaluation;
use App\Entity\Matiere;
use App\Form\ClasseType;
use App\Form\EvaluationType;
use App\Form\MatiereType;
use App\Repository\ClasseRepository;
use App\Repository\EvaluationRepository;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
#[Route('/admin/classe', name: 'admin_classe_')]
class ClasseController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ClasseRepository $classeRepository): Response
    {
        return $this->render('admin/classe/index.html.twig', [
         'liste'=>$classeRepository->findAll(),
        ]);
    }
    #[Route('/add', name: 'add')]
    public function classeAdd(EntityManagerInterface $entityManager,Request $request)
    {
        $classe=new classe();

        $form=$this->createForm(ClasseType::class,$classe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($classe);
            $entityManager->flush();
            $this->addFlash('succes','votre classe a bien ete ajouter');
            return $this->redirectToRoute('admin_classe_home');
        }
        return $this->render('admin/classe/ajout.html.twig', [
            'form' =>$form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'edit')]
    public function classeEdit(EntityManagerInterface $entityManager,Request $request,Classe $classe)
    {

        $form=$this->createForm(ClasseType::class,$classe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($classe);
            $entityManager->flush();
            return $this->redirectToRoute('admin_classe_home');
        }
        return $this->render('admin/classe/ajout.html.twig', [
            'form' =>$form->createView(),
        ]);
    }


}
