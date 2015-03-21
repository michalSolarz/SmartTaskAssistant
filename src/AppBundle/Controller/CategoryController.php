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
use AppBundle\Form\Type\YesNoType;




class CategoryController extends Controller
{

    /**
     * @Route("/category/", name="listCat")
     */
    public function indexAction()
    {
        return $this->render('category/categoryList.html.twig',
            array('categories' => $this->get('app_bundle.providers.list')->getCreatedByUser('AppBundle:Category')
            ));
    }


    /**
     * @Route("/category/add", name="addCat")
     */
	public function AddCategoryAction(Request $request)
	{
	    $category = new Category();

        $user = $this->getUser();

	    $form = $this->createForm(new CategoryType($user), $category);

	    if($form->handleRequest($request)->isValid()) {
	    	$entityManager = $this->getDoctrine()->getManager();
	    	$entityManager->persist($category);
	    	$entityManager->flush();
	    	return $this->redirect($this->generateUrl('listCat'));
	    }

	    return $this->render('category/categoryAdd.html.twig',array('form' => $form->createView()));;
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
            return $this->redirect($this->generateUrl('listCat'));
        }

        return $this->render('category/categoryEdit.html.twig', array('category' => $category, 'form' => $form->createView()));;
    }

    /**
     * @Route("/category/delete/{id}", name="delCat")
     */
    public function DelCategoryAction(Request $request, Category $category)
    {
        $form = $this->createForm(new YesNoType());

        if($form->handleRequest($request)->isValid()) {
            if($form->get('tak')->isClicked()) {
                $form = $this->createForm(new CategoryType(), $category);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($category);
                $entityManager->flush(); 
           
                return $this->redirect($this->generateUrl('listCat'));                
            } else {
                return $this->redirect($this->generateUrl('listCat'));                
            }
        }

        return $this->render('category/categoryDelete.html.twig', array('category' => $category, 'form' => $form->createView()));
    }
}



