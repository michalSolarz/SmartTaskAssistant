<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login_form")
     */
    public function indexAction()
    {


        
        return $this->render('security/login.html.twig');
    }



    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    }

}


