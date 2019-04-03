<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\QuestionsExternesType;
use App\Entity\QuestionsExternes;

class QuestionsExternesController extends AbstractController
{
    /**
     * @Route("/questions/externes", name="questions_externes")
     */
    public function index()
    {
        return $this->render('questions_externes/index.html.twig', [
            'controller_name' => 'QuestionsExternesController',
        ]);
    }

    /**
     * @Route("/questionsexternes/newQE/", name="crearQE")
     */
    public function newQE(Request $request)
    {
        $QE = new QuestionsExternes();

        $form = $this->createForm(QuestionsExternesType::class , $QE, array ('submit'=>'Crear QE'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $QE = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($QE);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova QE '.$QE->getNombre() .' creada!'
            );

            return $this->redirectToRoute('login'); 
        }

        return $this->render('questions_externes/questions_externes.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova QE',
        ));
    }
}
