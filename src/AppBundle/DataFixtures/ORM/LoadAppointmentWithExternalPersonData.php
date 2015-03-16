<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\AppointmentWithExternalPerson;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAppointmentWithExternalPersonData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $appointmentWithUser1 = new AppointmentWithExternalPerson();
            $appointmentWithUser1->setExternalPerson($this->getReference('externalPerson-' . $i));
            $appointmentWithUser1->setAppointment($this->getReference('appointment-' . $i));

            $n = $i + 10;

            $appointmentWithUser2 = new AppointmentWithExternalPerson();
            $appointmentWithUser2->setExternalPerson($this->getReference('externalPerson-' . $n));
            $appointmentWithUser2->setAppointment($this->getReference('appointment-' . $i));

            $manager->persist($appointmentWithUser1);
            $manager->persist($appointmentWithUser2);
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
        return 7;
    }
}