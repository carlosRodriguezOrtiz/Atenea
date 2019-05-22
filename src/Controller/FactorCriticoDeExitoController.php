<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AspecteQ;
use App\Entity\QuestionsInternes;
use App\Entity\QuestionsExternes;
use App\Entity\Binomio;
use App\Entity\FactorCriticoDeExito;


class FactorCriticoDeExitoController extends AbstractController
{
    /**
     * @Route("/factor/critico/de/exito", name="factor_critico_de_exito")
     */
    public function index()
    {
        return $this->render('factor_critico_de_exito/index.html.twig', [
            'controller_name' => 'FactorCriticoDeExitoController',
        ]);
    }

        /**
     * @Route("/dafo/factor-critico-exito-corporacion/{id<\d+>}", name="binomioCorporacion")
     */
    public function fceCorp($id)
    {
        $questionsExternes = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findByCorporacionId($id);

        $questionsInternes = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findByCorporacionId($id);
        $binomios = [];
        if(isset($_POST)){
           foreach ($_POST as $bin) {
            $binomio = $this->getDoctrine()
            ->getRepository(Binomio::class)
            ->find($bin);
            $binomio->setSelected(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($binomio);
            $entityManager->flush();
           }
        }
        $binomiosBBDD = $this->getDoctrine()
        ->getRepository(Binomio::class)->findBySelected();
        
        return $this->render('factor_critico_de_exito/fce.html.twig', [
            'binomios' => $binomiosBBDD,
            'id' => $id
        ]);
    }

        /**
     * @Route("/factor-critico-exito/corporacion/create/{id<\d+>}", name="binomioCorporacionCreate")
     */
    public function fceCorpCreate($id)
    {
        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                var_dump($key);
                $binomio = $this->getDoctrine()
                ->getRepository(Binomio::class)
                ->find($key);
                $fce = new FactorCriticoDeExito();
                $fce->setBinomio($binomio);
                $fce->setDescripcion($value);
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($fce);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('dafo_corporacion',['id' => $id]);
    }

        /**
     * @Route("/dafo/factor-critico-exito-corporacion/lista", name="listaFCEadmin")
     */
    public function listfceAdmin(){
        $factores =[];

        if($this->getUser()->getRole()->getNombre() == "ROLE_ADMIN"){

            $factores = $this->getDoctrine()
            ->getRepository(FactorCriticoDeExito::class)
            ->findAll();
        }

        return $this->render('factor_critico_de_exito/list.html.twig', [
            'factores' => $factores
        ]);


    }

    /**
     * @Route("/dafo/factor-critico-exito-corporacion/lista/{id<\d+>}", name="listaFCECorp")
     */
    public function listfceCorp($id){
        $factores = [];

        if($this->getUser()->getRole()->getNombre() == "ROLE_ADMIN" or  ($this->getUser()->getCorporacion() !=null and  $this->getUser()->getCorporacion()->getID() == $id)){
            $qis = $this->getDoctrine()
            ->getRepository(QuestionsInternes::class)
            ->findByCorporacionId($id);
           
            $qes = $this->getDoctrine()
            ->getRepository(QuestionsExternes::class)
            ->findByCorporacionId($id);
            
            $aspQs = [];
            foreach ($qis as $qi) {
              $aspQ =  $this->getDoctrine()
              ->getRepository(AspecteQ::class)
              ->findByQIId($qi->getId());
                foreach ($aspQ as $as) {
                   array_push($aspQs, $as);
                }
            }
            //Revisar
/*             foreach ($qes as $qe) {
                $aspQ =  $this->getDoctrine()
                ->getRepository(AspecteQ::class)
                ->findByQIId($qe->getId());
                  foreach ($aspQ as $as) {
                     array_push($aspQs, $as);
                  }
              } */

              $binomiosArray = [];
              foreach ($aspQs as $asp) {
                  $binomios = $this->getDoctrine()
                  ->getRepository(Binomio::class)
                  ->findByBinomioId($asp->getId());
                  foreach ($binomios as $bin) {
                      array_push($binomiosArray, $bin);
                  }
              } 
              foreach ($binomiosArray as $bin) {
                $factores2 = $this->getDoctrine()
                ->getRepository(FactorCriticoDeExito::class)
                ->findByBinomioId($bin->getId());
                foreach ($factores2 as $fac) {
                    array_push($factores, $fac);
                }
              }
        }

        return $this->render('factor_critico_de_exito/list.html.twig', [
            'factores' => $factores
        ]);


    }


}
