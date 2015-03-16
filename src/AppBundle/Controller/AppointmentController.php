<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 17:23
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppointmentController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $appointments = $em->getRepository('AppBundle:Appointment')->findAll();

        $this->render('appointment/index.html.twig', array('appointments' => $appointments));
    }

    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}