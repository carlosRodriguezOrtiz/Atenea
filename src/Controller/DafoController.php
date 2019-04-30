<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Dafo;
use App\Entity\Binomio;
use App\Entity\QuestionsInternes;
use App\Entity\QuestionsExternes;


class DafoController extends AbstractController
{
    /**
     * @Route("/dafo/list", name="dafo")
     */
    public function list()
    {
        $dafo = $this->getDoctrine()
        ->getRepository(Dafo::class)
        ->find(1);

        $debilitats = [];
        $amenaces = [];
        $fortaleses = [];
        $oportunitats = [];

        foreach ($dafo->getQuestionsInternes() as $qi) {
            if($qi->getTipus() == 'debilidad'){
                array_push($debilitats, $qi);
            } else {
                array_push($fortaleses, $qi);
            }
        }

        foreach ($dafo->getQuestionsExternes() as $qe) {
            if($qe->getTipus() == 'amenaza'){
                array_push($amenaces, $qe);
            } else {
                array_push($oportunitats, $qe);
            }
        }
        

        
        return $this->render('dafo/list.html.twig', [
            'debilitats' => $debilitats,
            'amenaces' => $amenaces,
            'fortaleses' => $fortaleses,
            'oportunitats' => $oportunitats,
        ]);
    }

        /**
     * @Route("/dafo/binomio", name="binomio")
     */
    public function binomio()
    {
        $dafo = $this->getDoctrine()
        ->getRepository(Dafo::class)
        ->find(1);

        $supervivencia = [];
        $ofensiva = [];
        $reorientacion = [];
        $defensiva = [];

        foreach ($dafo->getQuestionsInternes() as $qi) {
            
            foreach ($dafo->getQuestionsExternes() as $qe) {
                if($qi->getTipus()== "debilidad" && $qe->getTipus() == "amenaza"){
                    array_push($supervivencia,[$qi,$qe]);
                }else if($qi->getTipus()== "fortaleza" && $qe->getTipus() == "oportunidad"){
                    array_push($ofensiva,[$qi,$qe]);
                }else if($qi->getTipus()== "debilidad" && $qe->getTipus() == "oportunidad"){
                    array_push($reorientacion,[$qi,$qe]);
                }else if($qi->getTipus()== "fortaleza" && $qe->getTipus() == "amenaza"){
                    array_push($defensiva,[$qi,$qe]);
                }
            }
        }
        
        return $this->render('dafo/binomio.html.twig', [
            'supervivencia' => $supervivencia,
            'ofensiva' => $ofensiva,
            'reorientacion' => $reorientacion,
            'defensiva' => $defensiva
        ]);
    }

     /**
     * @Route("/dafo/binomio2", name="binomio2")
     */
    public function binomio2()
    {
        $QuestionsExternes = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findAll();
        $QuestionsInternes = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findAll();

        //var_dump($QuestionsExternes);
        $binomios = [];

        foreach ($QuestionsInternes as $qi) {
            foreach ($QuestionsExternes as $qe) {
                    $bi= new Binomio($qi,$qe);
                    array_push($binomios,$bi);
            }
        } 
        $binomios = [];
        $dafo = $this->getDoctrine()
        ->getRepository(Dafo::class)
        ->find(1);


        foreach ($QuestionsInternes as $qi) {
            
            foreach ($QuestionsExternes as $qe) {
                
                
                if($qi->getTipusDafo()->getTipus()== "debilidad" && $qe->getTipusDafo()->getTipus() == "amenaza"){
                    $bi= new Binomio();
                    $bi->setQuestionInterna($qi);
                    $bi->setQuestionExterna($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                    
                }else if($qi->getTipusDafo()->getTipus() == "fortaleza" && $qe->getTipusDafo()->getTipus() == "oportunidad"){
                    $bi= new Binomio();
                    $bi->setQuestionInterna($qi);
                    $bi->setQuestionExterna($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }else if($qi->getTipusDafo()->getTipus() == "debilidad" && $qe->getTipusDafo()->getTipus() == "oportunidad"){
                    $bi= new Binomio();
                    $bi->setQuestionInterna($qi);
                    $bi->setQuestionExterna($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }else if($qi->getTipusDafo()->getTipus() == "fortaleza" && $qe->getTipusDafo()->getTipus() == "amenaza"){
                    $bi= new Binomio();
                    $bi->setQuestionInterna($qi);
                    $bi->setQuestionExterna($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }
            }
        } 

        // foreach ($binomios as $bin){
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($bin);
        //     $entityManager->flush();
        // }

        $binomios2 = $this->getDoctrine()
        ->getRepository(Binomio::class)
        ->findAll();

        

        return $this->render('dafo/binomio2.html.twig', [
            'binomios' => $binomios2
        ]);
    }

     /**
     * @Route("/dafo/binomio3", name="binomio3")
     */
    public function binomio3()
    {
        if(isset($_POST)){
            var_dump($_POST);
            die();
        }

        return $this->render('dafo/binomio2.html.twig', [
            'binomios' => $binomios2
        ]);
    }

}
