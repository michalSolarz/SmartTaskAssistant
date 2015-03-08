<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 08.03.15
 * Time: 10:25
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\UserType;





class UserController extends Controller
{

    /**
     * @Route("/user", name="displayUsers")
     */
    public function indexAction(){

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle\Entity\User')->findAll();

        return $this->render(
            'user/index.html.twig',
            array('users' => $users)
        );
    }

    /**
     * @Route("/user/add", name="addUser")
     */
    public function addUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('addUser'),
        ));

        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('displayUsers'));
        }


        return $this->render(
            'user/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/user/edit/{id}", name="editUser")
     */
    public function editUserAction(Request $request, User $user)
    {
        $form = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('editUser', array('id' => $user->getId())),
        ));

        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirect($this->generateUrl('displayUsers'));
        }


        return $this->render(
            'user/edit.html.twig',
            array('form' => $form->createView())
        );
    }


}



