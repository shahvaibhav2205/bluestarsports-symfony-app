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
use AppBundle\Factory\PlayerFactory;
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
     * @Route("/createRoster/{id}", name="create_roster")
     */
    public function createRosterAction(Team $team)
    {
        $em = $this->getDoctrine()->getManager();

        while ($team->getCapacity() <= 15) {

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
}