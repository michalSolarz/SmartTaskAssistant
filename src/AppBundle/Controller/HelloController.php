<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 08.03.15
 * Time: 10:25
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;





class HelloController extends Controller
{

    /**
     * @Route("/hello", name="hello")
     */
    public function indexAction()
    {
        return $this->render('hello/index.html.twig');
    }



    /**
     * @Route("/test", name="d_t")
     */
    public function testAction()
    {

         $t = new Task();
        $u = new User();
        $u->setName("drgrgrth");
        $u->setEmail("abc@xyz.com");
        $u->setPassword("sfdg");
        $t->setCreatedBy($u);
        $c = new Category();
        $c->setName("test");
        $t->setCategory($c);
        $c->setColor("red");
        $t->setContent("qwertyuiop");
        $t->setDueDate(new \DateTime('now'));
        $t->setDone(true);
        $t->setPriority(2);



        $em = $this->getDoctrine()->getManager();
        $em->persist($c);
        $em->persist($u);
        $em->persist($t);
        $em->flush();

        return $this->render('hello/index.html.twig');

    }
}



