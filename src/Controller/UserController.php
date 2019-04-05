<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/edit/{id}", name="user_edit")
     */
    public function edit($id)
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }



    /**
     * @Route("/user/list", name="user")
     */
    public function list()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

       

        return $this->render('user/list.html.twig', ['user' => $user]);
    }







}
