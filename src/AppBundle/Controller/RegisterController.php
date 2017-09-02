<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 8/31/17
 * Time: 2:52 AM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Owner;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/register")
 */
class RegisterController extends Controller
{

    /**
     * @Route("/team", name="register_team")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function teamAction(Request $request)
    {
        /** @var Owner $owner */
        $owner = new Owner("");

        /** @var Team $team */
        $team = new Team("", $owner);

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $teamForm = $this->createForm(TeamType::class, $team);
        $teamForm->handleRequest($request);

        if ($teamForm->isSubmitted() && $teamForm->isValid()) {

            $team = $teamForm->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($owner);
            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('team_dashboard', ['id' => $team->getId()]);
        }

        return $this->render("@App/register_team.html.twig", [
            'form' =>   $teamForm->createView()
        ]);
    }
}