<?php
/**
 * Created by PhpStorm.
 * User: acastelain
 * Date: 03/05/2017
 * Time: 09:56
 */

namespace MGD\EventBundle\DataFixtures\ORM;


use AppBundle\DataFixtures\ORM\LoadObject;
use Doctrine\Common\Persistence\ObjectManager;
use MGD\EventBundle\Entity\Tournament;

class LoadTournament extends LoadObject
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tournament = new Tournament();
        $tournament->setTitle("Tournoi League of Legends");
        $tournament->setDescription($this->getLoremIpsum(10));
        $tournament->setNumberParticipantMax(20);
        $tournament->setCreationDate(new \DateTime());
        $tournament->setStartDate(new \DateTime("+4d"));
        $tournament->setEndDate(new \DateTime("+5d"));

        $manager->persist($tournament);
        $manager->flush();
    }
}