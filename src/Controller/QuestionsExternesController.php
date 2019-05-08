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
     * @Route("/qe/getTipsus", name="getTipusQE")
     */
    public function getTipus(){
        foreach ($qes as $qe) {
            $id = $qe->getId();
            $nombre = $qe->getNombre();   
            $elementos_json[] = "\"$id\": $nombre\"\"";
        }
        $string = "{" . implode(",", $elementos_json) . "}";
        return $this->handleView($string);
    }

     /**
     * @Route("/qe/getSubTipus", name="getSubTipusQE")
     */
    public function getSubTipus(Request $request){
        if($request->request){
            $qes = $this->getDoctrine()
            ->getRepository(TipusQE::class)
            ->find($id);
           
            foreach ($qes->getSubtipus() as $qe) {
                $id = $qe->getId();
                $nombre = $qe->getDescripcion();
                
                $elementos_json[] = "\"$id\": $nombre\"\"";
            }
            var_dump($elementos_json);
            die();
    
            $string = "{" . implode(",", $elementos_json) . "}";
            
            return new JsonRespones($string);
        }

        return $this->render('app/main/index.html.twig');
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
        if(isset($_POST['tipus'])){
            var_dump("<div id='pp'>".$_POST['tipus']."</div>");
            $qes = $this->getDoctrine()
            ->getRepository(TipusQE::class)
            ->find($_POST['tipus']);
            $subtipus = $qes->getSubtipus();
        }

        return $this->render('questions_externes/questions_externes.html.twig', array(
            // 'form' => $form->createView(),
            'title' => 'Nova QE',
            'tiposQE' => $tiposQE,
            'subtipus' => $subtipus
        ));
    }
}
