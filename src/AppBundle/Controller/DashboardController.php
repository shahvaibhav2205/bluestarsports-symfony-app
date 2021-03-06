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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package AppBundle\Controller
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * Shows the team and the players.
     *
     * @Route("/team/{id}", name="team_dashboard")
     */
    public function dashboardAction(Team $team)
    {
        return $this->render("@App/dashboard.html.twig",[
            'team'  =>  $team
        ]);
    }

    /**
     * Fills up the roster to the capacity.
     *
     * @Route("/fill/roster/{id}", name="fill_roster")
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
                $em->persist($player);
            }

        }
        $em->persist($team);
        $em->flush();

        return $this->redirectToRoute("team_dashboard", ['id'  =>  $team->getId()]);
    }

    /**
     * Randomly assigns roles to players.
     *
     * @Route("/assign/roles/{id}", name="assign_random_roles")
     */
    public function assignRolesAction(Team $team)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $starters = 10;
        $substitutes = 5;

        foreach ($team->getPlayers() as $teamPlayer) {

            $teamPlayer->assignRole($starters, $substitutes);
            $em->persist($teamPlayer);
        }

        $em->persist($team);
        $em->flush();

        return $this->redirectToRoute("team_dashboard", ['id'  =>  $team->getId()]);
    }

    /**
     * @Route("/delete/player/{id}", name="delete_player")
     */
    public function deletePlayerAction(Player $player)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        if ($player) {
            /** @var Team $team */
            $team = $player->getTeam();

            $team->removePlayer($player);
            $em->persist($player);
            $em->persist($team);
            $em->flush();

            return (new Response())->setStatusCode(Response::HTTP_OK);
        }

        return (new Response())->setStatusCode(Response::HTTP_BAD_REQUEST);


    }
}