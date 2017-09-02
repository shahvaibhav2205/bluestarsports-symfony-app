<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 9/2/17
 * Time: 9:37 AM
 */


namespace Test\AppBundle\Entity;

use AppBundle\Entity\Owner;
use AppBundle\Entity\Team;
use AppBundle\Factory\PlayerFactory;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public function testAddPlayer()
    {
        $team = new Team("Test", new Owner("TestOwner"));
        $player = PlayerFactory::createNewPlayer();

        $this->assertEquals(0, $team->getCapacity(), "Roster should be empty!");
        $this->assertEmpty($team->getPlayers(), "Roster should be empty!");

        $team->addPlayer($player);
        $count = count($team->getPlayers());

        $this->assertEquals(1, $team->getCapacity(), "Team capacity should be exactly 1");
        $this->assertEquals(1, $count, "Roster should have exactly 1 player");
    }

    public function testDeletePlayer()
    {
        $team = new Team("Test", new Owner("TestOwner"));
        $player = PlayerFactory::createNewPlayer();

        $team->addPlayer($player);

        $this->assertEquals(1, $team->getCapacity());

        $team->removePlayer($player);

        $this->assertEquals(0, $team->getCapacity(), "Team should have no player!");
        $this->assertNull($player->getTeam(), "Player should not have a team!");
    }

    public function testIsValidPlayer()
    {
        $team = new Team("Test", new Owner("TestOwner"));
        $player = PlayerFactory::createNewPlayer();

        $this->assertTrue($team->isValidPlayer($player), "When there are no player, it should be true!");

        $team->addPlayer($player);

        $this->assertFalse($team->isValidPlayer($player), "Should return false when same player is added again!");

        $player1 = PlayerFactory::createNewPlayer();
        $player1->setName($player->getname());

        $this->assertFalse($team->isValidPlayer($player), "Should return false when a player with same name is added again!");

        $player2 = PlayerFactory::createNewPlayer();
        $player2->setStrength($player->getStrength());
        $player2->setSpeed($player->getSpeed());
        $player2->setAgility($player->getAgility());

        $this->assertFalse($team->isValidPlayer($player), "Should return false when a player with same total score is added again!");

        $player3 = PlayerFactory::createNewPlayer();
        $player3->setSalary(200);

        $this->assertFalse($team->isValidPlayer($player), "Should return false since salary cap is 175!");
    }
}