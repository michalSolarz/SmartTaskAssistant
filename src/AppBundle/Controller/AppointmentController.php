<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 18.03.15
 * Time: 17:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Appointment;
use AppBundle\Form\Type\AppointmentType;
use AppBundle\Form\Type\YesNoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppointmentController extends Controller
{

    /**
     * @Route("/appointment", name="displayAppointments")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appointments = $em->getRepository('AppBundle\Entity\Appointment')->findAll();

        return $this->render('appointment/index.html.twig',
            array('appointments' => $appointments));
    }

    /**
     * @Route("/appointment/add", name="addAppointment")
     */
    public function addAppointmentAction(Request $request)
    {
        $appointment = new Appointment();

        $form = $this->createForm(new AppointmentType(), $appointment, array(
            'action' => $this->generateUrl('addAppointment')
        ));

        if ($form->handleRequest($request)->isValid()) {

        }

        return $this->render('appointment/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/appointment/edit/{id}", name="editAppointment")
     */
    public function editAppointmentAction(Request $request, Appointment $appointment)
    {
        $form = $this->createForm(new AppointmentType(), $appointment, array(
            'action' => $this->generateUrl('editAppointment',
                array('id' => $appointment->getId()
                ))
        ));

        if ($form->handleRequest($request)->isValid()) {

        }

        return $this->render('appointment/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/appointment/delete/{id}", name="deleteAppointment")
     */
    public function deleteAppointmentAction(Request $request, Appointment $appointment)
    {
        $form = $this->createForm(new YesNoType());

        if ($form->handleRequest($request)->isValid()) {

        }

        return $this->render('appointment/delete.html.twig',
            array(
                'form' => $form->createView()
            ));
    }
}