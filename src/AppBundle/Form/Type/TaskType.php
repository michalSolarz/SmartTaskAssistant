<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content','text')
            ->add('dueDate', 'date')
            ->add('done', 'checkbox')
            ->add('priority', 'choice', array('choices'=>array('l'=>'low', 'm'=>'medium','h'=>'high','u'=>'urgent')))
            ->add('assignee', 'entity',['class'=>'AppBundle:User'])
            ->add('createdBy', 'entity',['class'=>'AppBundle:User'])
            ->add('category', 'entity',['class'=>'AppBundle:Category']);


    }

    public function getName()
    {
        return 'task';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task')
        );
    }

}