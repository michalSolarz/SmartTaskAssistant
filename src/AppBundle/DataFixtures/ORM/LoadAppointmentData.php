<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Appointment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAppointmentData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $appointment = new Appointment();
            $appointment->setCreatedBy($this->getReference('user-' . $i));
            $appointment->addWithUser($this->getReference('user-' . $i));
            $manager->persist($appointment);

            $this->setReference('appointment-' . $i, $appointment);
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
        return 5;
    }
}