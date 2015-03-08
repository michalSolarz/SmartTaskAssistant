<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 08.03.15
 * Time: 10:25
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HelloController extends Controller
{

    /**
     * @Route("/hello", name="hello")
     */
    public function indexAction()
    {
        return $this->render('hello/index.html.twig');
    }
}