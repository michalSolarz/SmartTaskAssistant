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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\TaskType;
use AppBundle\Form\Type\YesNoType;


class TaskController extends Controller
{

    /**
     * @Route("/newtask", name="new_task")
     */
    public function newTaskAction(Request $request)
    {
        $task = new Task();  //*
        $form = $this->createForm('task', $task);  //*
        $form->handleRequest($request);

        if ($form->isValid()) {

            //    $task = $form->getData();   mozna tez tak zamiast w create form

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirect($this->generateUrl('list_tasks'));
        }

        return $this->render('task/task.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/edittask/{id}", name="edit_task")
     * @Method("POST")
     */
    public function editTaskAction(Request $request, Task $task)
    {


        $form = $this->createForm('task', $task);

        $form->handleRequest($request);

        

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirect($this->generateUrl('list_tasks'));
        }

        return $this->render('task/task.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/listtasks", name="list_tasks")
     */
    public function listTasksAction(Request $request)
    {

        return $this->render('task/list.html.twig',
            array('tasks' => $this->get('app_bundle.providers.list')->getCreatedByUser('AppBundle:Task')
            ));
    }

    /**
     * @Route("/deletetask/{id}", name="delete_task")
     * @Method("POST")
     */
    public function deleteTaskAction(Request $request, Task $task)
    {
        $form = $this->createForm(new YesNoType(), $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($form->get('tak')->isClicked()) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($task);
                $em->flush();

            }
            return $this->redirect($this->generateUrl('list_tasks'));
        }

        return $this->render('task/delete.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}