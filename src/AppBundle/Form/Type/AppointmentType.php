<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Appointment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;


class AppointmentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];



        $builder
            ->add('color', 'choice', array( 'choices' =>  array('danger' => 'red', 'success' => 'green', 'info' => 'blue', 'warning' => 'yellow')))
            ->add('title', 'text')
            ->add('whereIs', 'text')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('info', 'textarea')
            ->add('users', 'entity', array( 'class'=> 'AppBundle:User', 'multiple' => true, 'by_reference' => false, 'query_builder' => function(EntityRepository $er) use ($user) {
                return $er->createQueryBuilder('user')->where( 'user != :p') ->setParameter('p', $user);
            } ))
            ->add('externalPersons', 'entity', array( 'class'=> 'AppBundle:ExternalPerson', 'multiple' => true, 'by_reference' => false,));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Appointment')) ->setRequired(array('user')) ->setAllowedTypes(array('user' => 'AppBundle\Entity\User'));
    }


    public function getName()
    {
        return 'Appointment';
    }
}

