<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 18.03.15
 * Time: 17:07
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AppointmentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdBy', 'entity', ['class' => 'AppBundle:User', 'property' => 'name']);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'Appointment';
    }
}