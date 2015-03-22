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
        $note = "dgdhtdh";

        return $this->render('dashboard/dashboard.html.twig',
            array('user' => $user, 'note' => $note, 'tasks' => $this->get('app_bundle.providers.list')->getUpcomingTasks('AppBundle:Task')
            ));

    }

}
