<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:30
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername('Username'. $i);
            $user->setName('User ' . $i);
            $user->setEmail('user' . $i . '@localhost');
            $user->setPassword('123456');


            $manager->persist($user);

            $manager->flush();

            $this->addReference('user-'.$i, $user);
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}