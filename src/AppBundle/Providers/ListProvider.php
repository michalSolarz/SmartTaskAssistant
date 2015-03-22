<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 21.03.15
 * Time: 14:49
 */

namespace AppBundle\Providers;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use AppBundle\Entity\TaskRepository;


class ListProvider
{

    private $em;
    private $tokenStorageInterface;

    public function __construct(ObjectManager $em, TokenStorageInterface $tokenStorageInterface)
    {
        $this->em = $em;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public function getCreatedByUser($repo)
    {
        $repo = $this->em->getRepository($repo);
        $token = $this->tokenStorageInterface->getToken();

        if ($token) {
            return $repo->findBy(array('createdBy' => $token->getUser()));
        }
    }


    public function getUpcomingTasks($repo)
    {
        $repo = $this->em->getRepository($repo);
        $token = $this->tokenStorageInterface->getToken();

        if ($token) {

            $user = $token->getUser();

            return $repo->getUsersNotDoneTasks($user    );
        }
    }

    public function getCreatedByUserAndVisible($repo)
    {
        $repo = $this->em->getRepository($repo);
        $token = $this->tokenStorageInterface->getToken();

        if ($token) {
            return $repo->findBy(array(
                'createdBy' => $token->getUser(),
                'visible' => true
            ));
        }
    }

}