<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\QuestionsExternes;
use App\Entity\QuestionsInternes;
use App\Entity\SubTipusQE;
use App\Entity\TipusQE;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AspectesQController extends AbstractController
{

    /**
     * @Route("/aspectes", name="aspectes_q")
     */
    public function index()
    {
        $questions = null;
        return $this->render('aspec_fav_desfav/aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/aspectes/qi", name="aspectes_qI")
     */
    public function qI()
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsInternes::class)
        ->findAll();
        return $this->render('aspec_fav_desfav/aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "interna",
        ]);
    }

    /**
     * @Route("/aspectes/qe", name="aspectes_qE")
     */
    public function qE()
    {
        $questions = $this->getDoctrine()
        ->getRepository(QuestionsExternes::class)
        ->findAll();
        return $this->render('aspec_fav_desfav/aspec_fav_desfav.html.twig', [
            'title' => 'AspectesQController',
            'questions' => $questions,
            'q' => "externa",
        ]);
    }




}
