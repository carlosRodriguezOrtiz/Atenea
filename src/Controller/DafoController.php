<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Dafo;

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
                    //array_push($supervivencia,[$qi,$qe]);
                }else if($qi->getTipus()== "fortaleza" && $qe->getTipus() == "oportunidad"){
                    //array_push($ofensiva,[$qi,$qe]);
                }else if($qi->getTipus()== "debilidad" && $qe->getTipus() == "oportunidad"){
                    //array_push($reorientacion,[$qi,$qe]);
                }else if($qi->getTipus()== "fortaleza" && $qe->getTipus() == "amenaza"){
                    //array_push($defensiva,[$qi,$qe]);
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
}
