<?php
/**
 * Created by PhpStorm.
 * User: acastelain
 * Date: 03/05/2017
 * Time: 10:04
 */

namespace MGD\EventBundle\DataFixtures\ORM;


use AppBundle\DataFixtures\ORM\LoadObject;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MGD\EventBundle\Entity\Discovery;

class LoadDiscovery extends LoadObject implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $discovery = new Discovery();
        $discovery->setTitle("Découverte jeu de rôle");
        $discovery->setDescription($this->getLoremIpsum());
        $discovery->setCreationDate(new \DateTime());
        $discovery->setStartDate(new \DateTime("+25d"));
        $discovery->setEndDate(new \DateTime("+30d"));
        $discovery->setCover("http://placehold.it/400x250");

        $manager->persist($discovery);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}