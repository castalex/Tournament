<?php
/**
 * Created by PhpStorm.
 * User: acastelain
 * Date: 08/08/2017
 * Time: 14:28
 */

namespace MGD\EventBundle\Tests\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use MGD\EventBundle\Entity\Team;
use MGD\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamTest extends WebTestCase
{
    /** @var  User */
    private $leader;
    /** @var  Team */
    private $team;
    /** @var  ArrayCollection */
    private $players;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->leader = new User();
        $this->team = new Team();

        $player1 = new User();
        $player2 = new User();

        $this->players = new ArrayCollection(array($player1, $player2));
    }

    public function testGetPlayingUserIsCountCorrect() {
        $this->team->setLeader($this->leader);

        foreach ($this->players as $player) {
            $this->team->addPlayer($player);
        }

        $this->assertEquals(3, $this->team->getPlayingUsers()->count());
    }

    public function testGetPlayingUserIsLeaderInCount() {
        $this->team->setLeader($this->leader);

        $this->assertEquals(1, $this->team->getPlayingUsers()->count());
        $this->assertContains($this->leader, $this->team->getPlayingUsers());
    }
}
