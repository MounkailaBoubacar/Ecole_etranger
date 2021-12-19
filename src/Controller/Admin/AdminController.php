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

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }



}
