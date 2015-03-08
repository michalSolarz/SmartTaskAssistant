<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CategoryType;




class CategoryController extends Controller
{

    /**
     * @Route("/category/", name="categories")
     */
    public function indexAction()
    {
         $em = $this->getDoctrine()->getRepository('AppBundle:Category');
         $cat = $em->findAll();
        //$query = $em->createQuery('SELECT cat_name, cat_color, cat_created, created_by FROM AppBundle:Category');
        //$categories = $query->getResult();
        return $this->render('hello/categories.html.twig', array('cat' => $cat));
    }


    /**
     * @Route("/category/add", name="addCat")
     */
	public function AddCategoryAction(Request $request)
	{
	    $category = new Category();
	    $form = $this->createForm(new CategoryType(), $category);

	    if($form->handleRequest($request)->isValid()) {
	    	$entityManager = $this->getDoctrine()->getManager();
	    	$entityManager->persist($category);
	    	$entityManager->flush();
	    	return $this->redirect($this->generateUrl('categories'));
	    }

	    return $this->render('hello/categoryAdd.html.twig',array('form' => $form->createView()));;
	}

    /**
     * @Route("/category/edit/{id}", name="editCat")
     */
    public function EditCategoryAction(Request $request, Category $category)
    {
        
        $form = $this->createForm(new CategoryType(), $category);

        if($form->handleRequest($request)->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirect($this->generateUrl('categories'));
        }

        return $this->render('hello/categoryEdit.html.twig', array('form' => $form->createView()));;
    }
    
}



