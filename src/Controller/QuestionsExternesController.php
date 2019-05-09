<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\QuestionsExternes;
use App\Entity\TipusQE;



use App\Form\QuestionsExternesType;


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
     * @Route("/qe/list/", name="qe_list")
     */
    public function list()
    {
        $qe = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findAll();
        
            return $this->render('questions_externes/list.html.twig', ['qes' => $qe]);
    }

    /**
     * @Route("/qe/new", name="crearQE")
     */
    public function newQE(Request $request){
        // $QE = new QuestionsExternes();

        // $form = $this->createForm(QuestionsExternesType::class , $QE, array ('submit'=>'Crear QE'));

        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {

        //     $QE = $form->getData();

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($QE);
        //     $entityManager->flush();

        //     $this->addFlash(
        //         'notice',
        //         'Nova QE '.$QE->getNombre() .' creada!'
        //     );

        //     return $this->redirectToRoute('login'); 
        // }

        // if($POST){

        // }

        $subtipus = null;

        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();

        return $this->render('questions_externes/questions_externes.html.twig', array(
            // 'form' => $form->createView(),
            'title' => 'Nova QE',
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus
        ));
    }

    /**
     * @Route("/qe/getQE", name="getSubTipusQE")
     */
    public function getQE(Request $request){
        $subtipus = null;
        $tiposQE = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->findAll();
        
        $id = $request->request->get('idtipusQE');
        $qes = $this->getDoctrine()
        ->getRepository(TipusQE::class)
        ->find($id);
        $subtipus = $qes->getSubtipus();
        
        
        
        return $this->render('questions_externes/questions_externes.html.twig', array(
            // 'form' => $form->createView(),
            'title' => "POST",
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus
        ));
    }
}
