<?php
namespace App\Controller;

use App\Entity\Remorquage;
use App\Form\RemorquageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RemorquageRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RemorquageController extends AbstractController
{
    #[Route('/remorquage', name: 'remorquage_index')]
    public function index(): Response
    {
        $remorquages = $this->getDoctrine()->getRepository(Remorquage::class)->findAll();

        return $this->render('remorquage/index.html.twig', [
            'remorquages' => $remorquages,
        ]);
    }
    #[Route('/AfficheRemorquage', name: 'app_AfficheRemorquage')]
    public function Affiche (RemorquageRepository $repository)
        {
            $Remorquage=$repository->findAll() ; //select *
            return $this->render('Remorquage/affiche.html.twig',['Remorquage'=>$Remorquage]);
        }

    #[Route('AddRemorquage', name: 'remorquage_new')]
    function newRemorquage(Request $request): Response
{
    $remorquage = new Remorquage();
    $form = $this->createForm(RemorquageType::class, $remorquage);
    $form->add('Ajouter', SubmitType::class);

    $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($remorquage);
                $em->flush();

        $this->addFlash('success', 'Remorquage added successfully.');

        return $this->redirectToRoute('app_AfficheRemorquage');
    }

    return $this->render('remorquage/new.html.twig', [
        'f' => $form->createView(),
    ]);
}
#[Route('/remorquage/edit/{ref}', name: 'app_edit_remorquage')]
public function editRemorquage($ref, RemorquageRepository $repository, Request $request): Response
{
    $remorquage = $repository->find($ref);

    if (!$remorquage) {
        return $this->redirectToRoute('remorquage_index');
    }

    $form = $this->createForm(RemorquageType::class, $remorquage);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', 'Remorquage updated successfully.');

        return $this->redirectToRoute('app_AfficheRemorquage');
    }

    return $this->render('remorquage/edit.html.twig', [
        'f' => $form->createView(),
    ]);
}

#[Route('/remorquage/delete/{ref}', name: 'app_delete_remorquage')]
public function deleteRemorquage($ref, RemorquageRepository $repository): Response
{
    $remorquage = $repository->find($ref);

    if (!$remorquage) {
        return $this->redirectToRoute('remorquage_index');
    }

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($remorquage);
    $entityManager->flush();

    $this->addFlash('success', 'Remorquage deleted successfully.');

    return $this->redirectToRoute('app_AfficheRemorquage');
}
}