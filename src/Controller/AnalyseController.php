<?php

namespace App\Controller;

use App\Entity\Analyse;
use App\Repository\AnalyseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Forms;

class AnalyseController extends AbstractController
{
    #[Route('/analyse', name: 'app_analyse')]
    public function index(AnalyseRepository $repo): Response
    {
        $analyses=$repo->findAll('num de de analyse');
        Return $this->render('analyse/index.html.twig', ['controller_name' => 
    'AnalyseController','analyses'=>$analyses,]);
    }
    #[Route('analyse/new', name: 'analyse_create') ]
public function new(Request $request,EntityManagerInterface $entityManager): Response
{
// creates a article object and initializes some data for this example
$analyse = new Analyse();
$form = $this->createFormBuilder($analyse)
->add('nom', TextType::class)
->add('type',TextType::class)
->add('date', DateTimeType::class)
->add('save', SubmitType::class, ['label' => 'Create patient'])
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$analyse = $form->getData();
$entityManager->persist($analyse);
$entityManager->flush();
return $this->redirectToRoute('app_analyse');
}
return $this->render('/patient/create.html.twig', ['form' => $form,]);
}
#[Route('analyse/edit/{id}', name: 'analyse_update') ]  
public function update(Request $request,EntityManagerInterface $entityManager, int $id): Response
    {
        $analyse = $entityManager->getRepository(Analyse::class)->find($id);
        if (!$analyse) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $form = $this->createFormBuilder($analyse)
->add('nom', TextType::class)
->add('type',TextType::class)
->add('date', DateTimeType::class)
->add('save', SubmitType::class, ['label' => 'Create patient'])
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$analyse = $form->getData();
$entityManager->persist($analyse);
$entityManager->flush();
return $this->redirectToRoute('app_analyse');
}
return $this->render('/analyse/edit.html.twig', ['form' => $form,]);
}
#[Route('analyse/delete/{id}', name: 'analyse_delete') ]  
public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $analyse = $entityManager->getRepository(Analyse::class)->find($id);

        if (!$analyse) {
            throw $this->createNotFoundException(
                'No ord found for id '.$id
            );
        }

        $entityManager->remove($analyse);
        $entityManager->flush();

        return $this->redirectToRoute('app_analyse', [
            'id' => $analyse->getId()
        ]);
    }
    #[Route('analyse/valide/{id}', name: 'analyse_valide') ]  
public function valide(EntityManagerInterface $entityManager, int $id): Response
    {
        $analyse = $entityManager->getRepository(Analyse::class)->find($id);

        if (!$analyse) {
            throw $this->createNotFoundException(
                'No ord found for id '.$id
            );
        }

        $analyse->setValide('true');
        $entityManager->flush();

        return $this->redirectToRoute('app_analyse', [
            'id' => $analyse->getId()
        ]);
    }
}
