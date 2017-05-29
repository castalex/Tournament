<?php

namespace MGD\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MGD\UserBundle\Entity\User;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
    public function findWithoutProfile (User $user) {
        $qb2 = $this->createQueryBuilder("game")
            ->select("IDENTITY(gaming_profiles.game)")
            ->join("game.gamingProfiles", "gaming_profiles", "WITH", "gaming_profiles.user = :user");


      $query = $this->createQueryBuilder("game2");
      $query->where($query->expr()->notIn("game2.id", $qb2->getDQL()))
          ->setParameter("user", $user);

      return $query->getQuery()->getResult();
    }
}
