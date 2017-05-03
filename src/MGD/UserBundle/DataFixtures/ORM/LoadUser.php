<?php
/**
 * Created by PhpStorm.
 * User: acastelain
 * Date: 03/05/2017
 * Time: 10:29
 */

namespace MGD\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use MGD\UserBundle\Entity\User;

class LoadUser extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstname("John");
        $user->setLastname("Doe");
        $user->setPlainPassword("popo");
        $user->setEmail("johndoe@mock.com");
        $user->setUsername("jdoe");

        $manager->persist($user);
        $manager->flush();
    }
}