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
}
