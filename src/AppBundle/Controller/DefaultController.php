<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Appointment;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/testy", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find(1);




//        $em->flush();

//        var_dump($user);

        return $this->render('default/index.html.twig');
    }
}
