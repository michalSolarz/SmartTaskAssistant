<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Appointment;
use AppBundle\Form\Type\AppointmentType;
use AppBundle\Form\Type\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\YesNoType;




class AppointmentController extends Controller
{

    /**
     * @Route("/appointment/", name="listApp")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Appointment');
        $appointments = $em->findAll();

        return $this->render('appointment/index.html.twig', array('appointments' => $this->get('app_bundle.providers.list')->getCreatedByUser('AppBundle:Appointment')));


     }

    /**
     * @Route("/appointment/add", name="addApp")
     */
    public function AddAppointmentAction(Request $request)
    {
        $appointment = new Appointment();

        $user = $this->getUser();
        $form = $this->createForm(new AppointmentType(), $appointment, array('user' => $user));



        if($form->handleRequest($request)->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $appointment->addUser($user);
            $entityManager->persist($appointment);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('listApp'));
        }

        return $this->render('appointment/add.html.twig',array('form' => $form->createView()));;
    }

    /**
     * @Route("/appointment/edit/{id}", name="editApp")
     */
    public function EditAppointmentAction(Request $request, Appointment $appointment)
    {
        $user = $this->getUser();
        $form = $this->createForm(new AppointmentType(), $appointment, array('user' => $user));

        if($form->handleRequest($request)->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($appointment);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('listApp'));
        }

        return $this->render('appointment/edit.html.twig',array('form' => $form->createView()));;
    }

    /**
     * @Route("/appointment/delete/{id}", name="delApp")
     */
    public function DelAppointmentAction(Request $request, Appointment $appointment)
    {
        $form = $this->createForm(new YesNoType());

        if($form->handleRequest($request)->isValid()) {
            if($form->get('tak')->isClicked()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($appointment);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('listApp'));
            } else {
                return $this->redirect($this->generateUrl('listApp'));
            }
        }

        return $this->render('appointment/delete.html.twig', array('appointment' => $appointment, 'form' => $form->createView()));
    }

}



