<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 22.03.15
 * Time: 10:16
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Note;
use AppBundle\Form\Type\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\YesNoType;

class NoteController extends Controller
{
    /**
     * @Route("/note", name="displayNotes")
     */
    public function indexAction()
    {
        return $this->render('note/index.html.twig', array(
            'notes' => $this->get('app_bundle.providers.list')->getCreatedByUserAndVisible('AppBundle:Note')
        ));
    }

    /**
     * @Route("/note/add", name="addNote")
     */
    public function addNoteAction(Request $request)
    {
        $note = new Note();
        $form = $this->createForm(new NoteType(), $note, array(
            'action' => $this->generateUrl('addNote'),
        ));

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            return $this->redirect($this->generateUrl('displayNotes'));
        }


        return $this->render(
            'note/add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/note/edit/{id}", name="editNote")
     */
    public function editNoteAction(Request $request, Note $note)
    {
        $form = $this->createForm(new NoteType(), $note, array(
            'action' => $this->generateUrl('editNote', array('id' => $note->getId())),
        ));

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            return $this->redirect($this->generateUrl('displayNotes'));
        }


        return $this->render(
            'note/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/note/hide/{id}", name="hideNote")
     */
    public function hideNoteAction(Request $request, Note $note)
    {
        $form = $this->createForm(new YesNoType());

        if ($form->handleRequest($request)->isValid()) {
            if ($form->get('tak')->isClicked()) {
                $em = $this->getDoctrine()->getManager();
                $note->setVisible(false);
                $em->flush();
                return $this->redirect($this->generateUrl('displayNotes'));
            }
        }

        return $this->render(
            'note/hide.html.twig',
            array('form' => $form->createView())
        );
    }
}