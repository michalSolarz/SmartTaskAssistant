<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 18:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Note;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $note = new Note();

            $note->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
            bibendum efficitur blandit. Suspendisse luctus egestas massa vel dapibus. Sed ornare.');

            $note->setCreatedBy($this->getReference('user-' . mt_rand(0, 9)));

            $note->setVisible(true);

            $manager->persist($note);

            $manager->flush();

            $this->addReference('note-'. $i, $note);
        }
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