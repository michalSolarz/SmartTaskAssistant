<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 22.03.15
 * Time: 12:48
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends Controller
{
    /**
     * @Route("/notification", name="displayNotifications")
     */
    public function indexAction()
    {

    }

    /**
     * @Route("/notification/add", name="addNotification")
     */
    public function addNotificationAction(){

    }

    /**
     * @Route("/notification/edit/{id}", name="editNotification")
     */
    public function editNotificationAction(){

    }

    /**
     * @Route("/notification/delete/{id}", name="deleteNotification")
     */
    public function deleteNotificationAction(){

    }
}