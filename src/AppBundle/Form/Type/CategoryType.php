<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;


class CategoryType extends AbstractType
{
    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('name', 'text')
        	->add('color', 'choice', array( 'choices' =>  array('danger' => 'red', 'success' => 'green', 'info' => 'blue', 'warning' => 'yellow')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
    	$resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Category'));
    }


    public function getName()
    {
        return 'Category';
    }
}

