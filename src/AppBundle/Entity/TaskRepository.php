<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{


public function getUsersNotDoneTasks (User $user = NULL){

        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT t, u FROM AppBundle:Task t
            JOIN t.assignee u
            WHERE u = :user AND t.done = 0 ORDER BY t.priority DESC'
        )->setParameter('user', $user);


        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function getTasksForReminder()
    {

        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT t, u FROM AppBundle:Task t
            JOIN t.assignee u
            WHERE t.done = 0'
            );

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }



}