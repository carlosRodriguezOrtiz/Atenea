<?php

namespace App\Controller;
use App\Entity\Dafo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmergenteController extends AbstractController
{
    /**
     * @Route("/emergente/dafo/{id}", name="dafo")
     */
    public function list($id)
    {
        $dafo = $this->getDoctrine()
        ->getRepository(Dafo::class)
        ->find($id);

        $debilitats = [];
        $amenaces = [];
        $fortaleses = [];
        $oportunitats = [];

        if($dafo != null){
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
    }
        

        

        
        return $this->render('dafo/list.html.twig', [
            'debilitats' => $debilitats,
            'amenaces' => $amenaces,
            'fortaleses' => $fortaleses,
            'oportunitats' => $oportunitats,
        ]);
    }


    
}
