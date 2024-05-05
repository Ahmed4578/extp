<?php

namespace App\Controller;

use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Forms;
class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(PatientRepository $repo): Response
    {
        $patients=$repo->findAll('num de de oradonnance');
        Return $this->render('patient/index.html.twig', ['controller_name' => 
    'PatientController','patients'=>$patients,]);
    }
    #[Route('patient/new', name: 'Patient_create') ]
public function new(Request $request,EntityManagerInterface $entityManager): Response
{
// creates a article object and initializes some data for this example
$patient = new Patient();
$form = $this->createFormBuilder($patient)
->add('nom', TextType::class)
->add('prenom',TextType::class)
->add('date_de_naissance', DateTimeType::class)
->add('adresse', TextType::class)
->add('num_telephone', TextType::class)
->add('save', SubmitType::class, ['label' => 'Create patient'])
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$patient = $form->getData();
$entityManager->persist($patient);
$entityManager->flush();
return $this->redirectToRoute('app_patient');
}
return $this->render('/patient/create.html.twig', ['form' => $form,]);
}
#[Route('patient/edit/{id}', name: 'patient_update') ]  
public function update(Request $request,EntityManagerInterface $entityManager, int $id): Response
    {
        $patient = $entityManager->getRepository(Patient::class)->find($id);
        if (!$patient) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $form = $this->createFormBuilder($patient)
        ->add('nom', TextType::class)
        ->add('prenom',TextType::class)
        ->add('date_de_naissance', DateTimeType::class)
        ->add('adresse', TextType::class)
        ->add('num_telephone', TextType::class)
->add('save', SubmitType::class, ['label' => 'edit patient'])
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$patient = $form->getData();
$entityManager->persist($patient);
$entityManager->flush();
return $this->redirectToRoute('app_patient');
}
return $this->render('/patient/edit.html.twig', ['form' => $form,]);
}
#[Route('patient/delete/{id}', name: 'patient_delete') ]  
public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $patient = $entityManager->getRepository(Patient::class)->find($id);

        if (!$patient) {
            throw $this->createNotFoundException(
                'No ord found for id '.$id
            );
        }

        $entityManager->remove($patient);
        $entityManager->flush();

        return $this->redirectToRoute('app_patient', [
            'id' => $patient->getId()
        ]);
    }
}
