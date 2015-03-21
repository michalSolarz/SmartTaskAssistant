<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\ExternalPerson;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadExternalPersonData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $externalPerson = new ExternalPerson();
            $externalPerson->setEmail('externalPerson' . $i . '.@localhost');
            $externalPerson->setName('External Person ' . $i);

            $manager->persist($externalPerson);

            $this->addReference('externalPerson-'.$i, $externalPerson);
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
        return 4;
    }
}