<?php
/**
 * Created by PhpStorm.
 * User: acastelain
 * Date: 31/05/2017
 * Time: 17:20
 */

namespace MGD\EventBundle\Service;


use MGD\EventBundle\Entity\Team;
use MGD\UserBundle\Entity\User;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ApplicationChecker
{
    /**
     * @var Router
     */
    private $router;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;
    /**
     * @var TeamChecker
     */
    private $teamChecker;

    public function __construct(Router $router, AuthorizationCheckerInterface $authorizationChecker, TeamChecker $teamChecker)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
        $this->teamChecker = $teamChecker;
    }

    /**
     * This methods check if the user can apply to the team, it search if he have a username for the game and if he doens't already applied for another team in the same tournament
     * @param User $user
     * @param Team $team
     * @return bool|string
     */
    public function canApply(User $user, Team $team)
    {
        if ($user->getGamingUsername($team->getTournament()->getGame()) === null) {
            return "Vous devez avoir un nom d'utilisateur pour pouvoir vous inscrire, renseignez le dans \"Mon profil\"";
        } else if (false !== $teamAlreadyIn = $this->teamChecker->isAlreadyApplicant($user, $team)) {
            return "Vous avez déjà postulé pour une équipe pour ce tournoi : 
            <a href=\"" . $this->router->generate("mgd_team_show", array("id" => $teamAlreadyIn->getId())) . "\">" . htmlspecialchars($teamAlreadyIn->getName()) . "</a>";
        }
        return true;
    }

    /**
     * Check if a user can quit a team
     * @param User $user
     * @param Team $team
     * @return bool
     */
    public function canQuit(User $user, Team $team)
    {
        return !$user->getManagedTeam()->contains($team);
    }

    public function isUserWithThisTeam(User $user, Team $team)
    {
        return ($team->getApplicants()->contains($user) || $team->getPlayingUsers()->contains($user));
    }
}
