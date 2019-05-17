<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\QuestionsInternesType;
use App\Entity\QuestionsInternes;

class QuestionsInternesController extends AbstractController
{
   

    /**
     * @Route("/questionsinternesEmpresas/{id}", name="qi_listEmpresas")
     */
    public function listEmpresasInternes($id)
    {
            $qi = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($id);
        
            return $this->render('questions_internes/list.html.twig', ['qis' => $qi]);

    }

        /**
     * @Route("/questionsinternesCentros/{id}", name="qi_listCentros")
     */
    public function listCentrosInternes($id)
    {
        $qi = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->find($id);

            return $this->render('questions_internes/list.html.twig', ['qis' => $qi]);

    }


    /**
     * @Route("/questionsinternes/new", name="crearQI")
     */
    public function newQI(Request $request)
    {
        $QI = new QuestionsInternes();

        $form = $this->createForm(QuestionsInternesType::class , $QI, array ('submit'=>'Crear QI'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $QI = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($QI);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nova QI '.$QI->getNombre() .' creada!'
            );

            return $this->redirectToRoute('login'); 
        }

        return $this->render('questions_internes/questions_internes.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nova QI',
        ));
    }
}
