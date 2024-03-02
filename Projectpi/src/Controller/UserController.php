<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\UserRepository;



class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(Request $request): Response 
    {

        $form = $this->createForm(LoginType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

        }

        return $this->render('user/login.html.twig', [
            'loginForm' => $form->createView(),
        ]);
    }

    #[Route('/signup', name: 'app_signup')]
    public function signup(Request $request): Response 
    {

        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=new User();
            $form = $this->createForm(UserType::class,$user);
        }

        return $this->render('user/signup.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}