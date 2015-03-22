<?php
/**
 * Created by PhpStorm.
 * User: agata
 * Date: 21/03/15
 * Time: 15:27
 */


namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;



class DashboardController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getRepository('AppBundle:Task');
        $tasks = $em->findBy(array('assignee' => $user));

        $note="dgdhtdh";

        
        return $this->render('dashboard/dashboard.html.twig', array('tasks'=>$tasks, 'user'=>$user, 'note'=>$note));
    }

}
