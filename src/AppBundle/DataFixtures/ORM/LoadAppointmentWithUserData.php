<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\AppointmentWithUser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAppointmentWithUserData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        $n = 9;
        for ($i = 0; $i < 10; $i++) {
            $appointmentWithUser = new AppointmentWithUser();
            $appointmentWithUser->setUser($this->getReference('user-' . $n));
            $n--;
            $appointmentWithUser->setAppointment($this->getReference('appointment-' . $i));

            $manager->persist($appointmentWithUser);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 6;
    }
}