<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Dafo;
use App\Entity\QuestionsExternes;
use App\Entity\QuestionsInternes;
use App\Entity\Binomio;
use App\Entity\FactorCriticoDeExito;
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

        $questionsInternes = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCorporacionId($id);

        
        $debilitats = [];
        $amenaces = [];
        $fortaleses = [];
        $oportunitats = [];

        foreach ($questionsInternes as $qi) {
            foreach ($qi->getAspecteQs() as $asQ) {
                if($asQ->getDafo() == 'D'){
                    array_push($debilitats, $asQ);
                } else {
                    array_push($fortaleses, $asQ);
                }
            }
        }

        foreach ($aspectesQce as $qe) {
            foreach ($qe->getAspecteQs() as $asQ) {
            if($asQ->getDafo() == 'A'){
                array_push($amenaces, $asQ);
            } else {
                array_push($oportunitats, $asQ);
            }
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
     * @Route("/dafo/binomio-corporacion/{id<\d+>}", name="binomioCorp")
     */
    public function binomio($id)
    {
        $questionsExternes = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCorporacionId($id);

        $questionsInternes = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCorporacionId($id);

        $array_AspQEx = [];
        $array_AspQIn = [];
        $binomios = [];
        foreach ($questionsInternes as $qi) {
            foreach ($qi->getAspecteQs() as $as) {
                array_push($array_AspQIn,$as);
            }
           
        }
            
        foreach ($questionsExternes as $qe) {
            foreach ($qe->getAspecteQs() as $as) {
                array_push($array_AspQEx, $as);
            }
        }

        foreach ($array_AspQIn as $qi) {
            
            foreach ($array_AspQEx as $qe) {
                
                
                if($qi->getDafo()== "D" && $qe->getDafo() == "A"){
                    $bi= new Binomio();
                    $bi->addAspectesQ($qi);
                    $bi->addAspectesQ($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }else if($qi->getDafo() == "F" && $qe->getDafo() == "O"){
                    $bi= new Binomio();
                    $bi->addAspectesQ($qi);
                    $bi->addAspectesQ($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }else if($qi->getDafo() == "D" && $qe->getDafo() == "O"){
                    $bi= new Binomio();
                    $bi->addAspectesQ($qi);
                    $bi->addAspectesQ($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }else if($qi->getDafo() == "F" && $qe->getDafo() == "A"){
                    $bi= new Binomio();
                    $bi->addAspectesQ($qi);
                    $bi->addAspectesQ($qe);
                    $bi->setSelected(false);
                    array_push($binomios,$bi);
                }
            }
        } 
     
        foreach ($binomios as $bin){
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($bin);
             $entityManager->flush();
        }
             
        $binomios2 = $this->getDoctrine()
        ->getRepository(Binomio::class)
        ->findAll();
        return $this->render('dafo/binomioCorp.html.twig', [
            'binomios' => $binomios,
            'id' =>$id
        ]);
    }

}
