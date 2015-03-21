<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:53
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $task0 = $this->generateTask(0, $i);
            $manager->persist($task0);

            $task1 = $this->generateTask(1, $i);
            $manager->persist($task1);

            $task2 = $this->generateTask(2, $i);
            $manager->persist($task2);

            $task3 = $this->generateTask(3, $i);
            $manager->persist($task3);

            $task4 = $this->generateTask(4, $i);
            $manager->persist($task4);

        }
        $manager->flush();
    }

    private function generateTask($number, $i)
    {
        $task = new Task();
        $task->setCategory($this->getReference('category-' . $number));
        $task->setCreatedBy($this->getReference('user-' . mt_rand(0, 9)));
        $task->setAssignee($this->getReference('user-' . mt_rand(0, 9)));
        $task->setContent(mt_rand(0, time()));
        $task->setPriority(mt_rand(0, 4));
        if (mt_rand(0, 1) == 0) {
            $task->setDone(false);
        } else {
            $task->setDone(true);
        }
        $i++;
        $time = new \DateTime('now');
        $time->add(new \DateInterval('P' . $i . 'D'));
        $task->setDueDate($time);

        return $task;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}