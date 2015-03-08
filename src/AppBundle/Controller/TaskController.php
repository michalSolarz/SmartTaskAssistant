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
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\TaskType;


class TaskController extends Controller
{

    /**
     * @Route("/newtask", name="new_task")
     */
    public function newTaskAction(Request $request)
    {

        $task = new Task();  //*

        $form = $this->createForm(new TaskType(), $task);  //*

        $form->handleRequest($request);

        if ($form->isValid()) {

            //    $task = $form->getData();   mozna tez tak zamiast w create form

            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush();


            return $this->redirect($this->generateUrl('success'));
        }


        return $this->render('task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/edittask/{id}", name="edit_task")
     */
    public function editTaskAction(Request $request, Task $task)
    {


        $form = $this->createForm(new TaskType(), $task);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirect($this->generateUrl('success'));
        }


        return $this->render('task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/listtasks", name="list_tasks")
     */
    public function listTasksAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $tasks = $repository->findAll();


        return $this->render('task/list.html.twig', array('tasks' => $tasks));
    }


    /**
     * @Route("/success", name="success")
     */
    public function successAction()
    {
        return $this->render('task/success.html.twig');
    }


}