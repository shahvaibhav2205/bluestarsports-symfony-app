<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 9/1/17
 * Time: 6:43 PM
 */

namespace AppBundle\Enum;


use MyCLabs\Enum\Enum;

class PlayerRoleEnum extends Enum
{
    const STARTER = "starter";
    const SUBSTITUTE = "substitute";
    const UNASSIGNED = "unassigned";
}