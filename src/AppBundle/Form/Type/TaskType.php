<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TaskType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $token = $this->tokenStorage->getToken();
     $user =    $token->getUser();

        $builder
            ->add('content', 'text')
            ->add('dueDate', 'date')
            ->add('done', 'checkbox', array('required' => false))
            ->add('priority', 'choice', array('choices' => array('l' => 'low', 'm' => 'medium', 'h' => 'high', 'u' => 'urgent')))
            ->add('assignee', 'entity', ['class' => 'AppBundle:User', 'property' => 'name'])
            ->add('category', 'entity', ['class' => 'AppBundle:Category', 'property' => 'name',
                'query_builder' => function(EntityRepository $er) use ($user) {
                         return $er->createQueryBuilder('c')
                             ->join('c.createdBy', 'u')
                             ->where('u = :user')->setParameter('user', $user)
                            ->orderBy('u.username', 'ASC');
                },
            ]);


    }






    public function getName()
    {
        return 'task';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Task'));
    }

}