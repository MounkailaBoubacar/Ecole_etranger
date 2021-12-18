<?php

namespace App\Controller\Admin;


use App\Entity\User;

use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use App\Security\UserAuthenticator;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Message;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

#[Route('/admin/prof', name: 'admin_prof_')]
class ProfController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/prof/index.html.twig', [
             'liste'=>$userRepository->findByRoleThatSucksLess("PROF")
        ]);
    }
    #[Route('/add', name: 'add')]
    public function prof(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_PROF"]);
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('admin_prof_home');

        }

        return $this->render('admin/prof/ajout.html.twig', [
            'registrationForm' => $form->createView(),        ]);
    }
    #[Route('/edit/{id}', name: 'edit')]
    public function profEdit(EntityManagerInterface $entityManager,Request $request,User $user)
    {

        $form=$this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('admin_prof_home');
        }
        return $this->render('admin/prof/ajout.html.twig', [
            'registrationForm' => $form->createView(),        ]);
    }


}
