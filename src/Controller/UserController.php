<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{

    public function getUsers(){
        
        $em = $this->getDoctrine()->getManager();
        $listUsers = $em->getRepository("App:Users")->findBy(["status" => 1]);

        return $this->render('user/users.html.twig', [
            'lista' => $listUsers
        ]);
    }
}
