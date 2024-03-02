<?php

namespace App\Controller;
use App\Entity\Accident;
use App\Entity\User;
use App\Form\AccidentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AccidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccidentController extends AbstractController
{
    #[Route('/accident', name: 'app_accident')]
    public function index(): Response
    {
        return $this->render('accident/index.html.twig', [
            'controller_name' => 'AccidentController',
        ]);
    }


    #[Route('/AfficheAccident', name: 'app_AfficheAccident')]
    public function Affiche (AccidentRepository $repository)
        {
            $Accident=$repository->findAll() ; //select *
            return $this->render('Accident/Affiche.html.twig',['Accident'=>$Accident]);
        }



        #[Route('/AddAccident', name: 'app_Add')]
        #[Route('/AddAccident', name: 'app_Add')]
        public function Add(Request $request): Response
        {
            $accident = new Accident();
            $form = $this->createForm(AccidentType::class, $accident);
            $form->add('Ajouter', SubmitType::class);
        
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($accident);
                $em->flush();
        
                
                $accidentId = $accident->getId();
        
               
                return $this->render('Accident/added.html.twig', ['accidentId' => $accidentId]);
            }
        
            return $this->render('Accident/ajout.html.twig', ['f' => $form->createView()]);
        }

        #[Route('/accidents/delete/{ref}', name: 'app_delete_accident')]
public function deleteAccident($ref, AccidentRepository $repository, Request $request): Response
{
    $accident = $repository->find($ref);

    if (!$accident) {
        
        return $this->render('app_Add');
    }

    $accidentId = $accident->getId();
    

   
    $em = $this->getDoctrine()->getManager();
    $em->remove($accident);
    $em->flush();
    
   
    $referer = $request->headers->get('referer');
    
    
    if (strpos($referer, '/AfficheAccident') == false) {
      
        return $this->render('front/index.html.twig');
    } else {
        
        return $this->render('front/index.html.twig');
    }
}
        #[Route('/accidents/edit/{ref}', name: 'app_edit_accident')]
    public function editAccident($ref, AccidentRepository $repository, Request $request): Response
    {
        $accident = $repository->find($ref);
    
        if (!$accident) {
            return $this->redirectToRoute('app_AfficheAccident');
        }
    
        $form = $this->createForm(AccidentType::class, $accident);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $accidentId = $accident->getId();
    
            return $this->render('Accident/added.html.twig', ['accidentId' => $accidentId]);
        }
    
        return $this->render('Accident/edit.html.twig', [
            'f' => $form->createView(),
        ]);
    }

    
}
