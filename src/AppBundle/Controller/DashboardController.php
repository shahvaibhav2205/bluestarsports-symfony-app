<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 9/1/17
 * Time: 7:05 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use AppBundle\Enum\PlayerRoleEnum;
use AppBundle\Factory\PlayerFactory;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package AppBundle\Controller
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/team/{id}", name="team_dashboard")
     */
    public function dashboardAction(Team $team)
    {
        return $this->render("@App/dashboard.html.twig",[
            'team'  =>  $team
        ]);
    }

    /**
     * @Route("/create_roster/{id}", name="create_roster")
     */
    public function createRosterAction(Team $team)
    {
        $em = $this->getDoctrine()->getManager();

        while ($team->getCapacity() < 15) {

            /** @var Player $player */
            $player = PlayerFactory::createNewPlayer();

            if ($team->isValidPlayer($player)) {
                $team->addPlayer($player);
                $player->setTeam($team);
                $team->setCapacity($team->getCapacity()+1);
                $em->persist($player);
            }

        }
        $em->persist($team);
        $em->flush();

        return $this->redirectToRoute("team_dashboard", ['id'  =>  $team->getId()]);
    }

    /**
     * @Route("/assign_roles/{id}", name="assign_random_roles")
     */
    public function assignRolesAction(Team $team)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $starters = 10;
        $substitutes = 5;

        foreach ($team->getPlayers() as $teamPlayer) {

            if ($starters > 0 && $substitutes > 0) {
                if (rand(1,2) == 1) {
                    $teamPlayer->setRole(PlayerRoleEnum::STARTER);
                    $starters--;
                } else {
                    $teamPlayer->setRole(PlayerRoleEnum::SUBSTITUTE);
                    $substitutes--;
                }
            } elseif ($starters > 0) {
                $teamPlayer->setRole(PlayerRoleEnum::STARTER);
                $starters--;
            } else {
                $teamPlayer->setRole(PlayerRoleEnum::SUBSTITUTE);
                $substitutes--;
            }

            $em->persist($teamPlayer);
        }


        $em->persist($team);
        $em->flush();

        return $this->redirectToRoute("team_dashboard", ['id'  =>  $team->getId()]);
    }
}