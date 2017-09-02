<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 9/2/17
 * Time: 11:34 AM
 */

namespace Test\AppBundle\Entity;


use AppBundle\Enum\PlayerRoleEnum;
use AppBundle\Factory\PlayerFactory;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testAssignRole()
    {
        $player = PlayerFactory::createNewPlayer();

        $starter = 0;
        $substitute = 5;
        $player->assignRole($starter,$substitute);

        $this->assertEquals(PlayerRoleEnum::SUBSTITUTE, $player->getRole(), "Role shoule be Substitute when only substitutes remains");

        $starter = 5;
        $substitute = 0;
        $player->assignRole($starter,$substitute);

        $this->assertEquals(PlayerRoleEnum::STARTER, $player->getRole(), "Role shoule be Starter when only substitutes remains");

        $starter = 10;
        $substitute = 5;
        $player->assignRole($starter,$substitute);
        $this->assertTrue(in_array($player->getRole(), [PlayerRoleEnum::STARTER, PlayerRoleEnum::SUBSTITUTE]), "Role shoule be Starter or Substitute");

    }
}