<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login_form")
     */
    public function indexAction()
    {
        return $this->render('security/login.html.twig');
    }





}


