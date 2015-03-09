<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;


class CategoryType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('name', 'text')
        	->add('color', 'choice', array( 'choices' =>  array('red' => 'red', 'green' => 'green', 'blue' => 'blue')))
            //->add('color', 'choice', array( 'choice_list' =>  new ChoiceList(array('red', 'g', 'b'), array('red', 'green', 'blue'))))
            ->add('createdBy', 'entity', ['class' => 'AppBundle:User', 'property' => 'name']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
    	$resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Category'));
    }


    public function getName()
    {
        return 'Category';
    }
}

