<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 21.03.15
 * Time: 12:50
 */

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Task;
use AppBundle\Entity\Category;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use AppBundle\Interfaces\entityAuthorInterface;


class EntityAuthor
{
    protected $tokenStorageInterface;

    public function __construct(TokenStorageInterface $tokenStorageInterface)
    {
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        $token = $this->tokenStorageInterface->getToken();

        if($entity instanceof entityAuthorInterface) {
            try {
                if ($token) {
                    $entity->setCreatedBy($token->getUser());
                }
            } catch (Exception $e) {
                throw new \Exception('User not logged');
            }
        }

    }
}