<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/user/list", name="user_list")
     */
    public function list()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

       

        return $this->render('user/list.html.twig', ['user' => $user]);
    }


    /**
     * @Route("/users/delete/{id<\d+>}", name="user_delete")
     */
    public function delete($id, Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $nomUser = $user->getUsername();
        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Usuario '.$nomUser.' eliminada!'
        );

        return $this->redirectToRoute('user_list');
    }







}
