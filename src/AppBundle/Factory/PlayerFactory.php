<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 9/1/17
 * Time: 6:30 PM
 */

namespace AppBundle\Factory;


use AppBundle\Entity\Player;
use AppBundle\Enum\PlayerRoleEnum;

/**
 * Class PlayerFactory
 * @package AppBundle\Factory
 */
class PlayerFactory
{
    /**
     * @return Player
     */
    public static function createNewPlayer()
    {
        $player = new Player();
        $player->setName(PlayerFactory::randomName(10));
        $player->setSpeed(rand(1,50));
        $player->setAgility(rand(1,50));
        $player->setStrength(rand(1,50));
        $player->setSalary(rand(1,175));
        $player->setRole(PlayerRoleEnum::UNASSIGNED);

        return $player;
    }

    public static function randomName($length) {
        $pool = array_merge(range(0,9),range('A', 'Z'));

        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }
        return $key;
    }

}