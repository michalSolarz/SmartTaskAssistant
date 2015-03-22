<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{

public function getUsersNotDoneTasks ($id){

    $query = $this->getEntityManager()
        ->createQuery(
            'SELECT t, u FROM AppBundle:Task t
            JOIN t.assignee u
            WHERE u.id = :id AND t.done = 0 ORDER BY t.priority DESC'
        )->setParameter('id', $id);



    try {
        return $query->getResult();
    } catch (\Doctrine\ORM\NoResultException $e) {
        return null;
    }

}






}