<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Dafo;
use App\Entity\QuestionsExternes;
use App\Entity\QuestionsInternes;

class DafoController extends AbstractController
{
    /**
     * @Route("/dafo-corporacion/list/{id<\d+>}", name="dafo_corporacion")
     */
    public function list($id)
    {
        $aspectesQce = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCorporacionId($id);

        $aspectesQci = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCorporacionId($id);

        
        $debilitats = [];
        $amenaces = [];
        $fortaleses = [];
        $oportunitats = [];

        foreach ($aspectesQci as $qi) {
            if($qi->getAspecteQ()->getDafo() == 'D'){
                array_push($debilitats, $qi);
            } else {
                array_push($fortaleses, $qi);
            }
        }

        foreach ($aspectesQce as $qe) {
            if($qe->getAspecteQ()->getDafo() == 'A'){
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
            'id' => $id,
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
