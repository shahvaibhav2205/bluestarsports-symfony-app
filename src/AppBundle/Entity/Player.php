<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 8/31/17
 * Time: 2:14 AM
 */

namespace AppBundle\Entity;


use AppBundle\Enum\PlayerRoleEnum;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Player
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $speed;

    /**
     * @ORM\Column(type="integer")
     */
    protected $agility;

    /**
     * @ORM\Column(type="integer")
     */
    protected $strength;

    /**
     * @ORM\Column(type="integer")
     */
    protected $salary;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="players")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $team;

    /**
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     * @return Player
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @param mixed $agility
     * @return Player
     */
    public function setAgility($agility)
    {
        $this->agility = $agility;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     * @return Player
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     * @return Player
     */
    public function setTeam($team)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return Player
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
    /**
    * @return integer
    */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
    * @param integer $salary
    */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return integer
     */
    public function getTotalAttributeScore()
    {
        return $this->getSpeed() + $this->getStrength() + $this->getAgility();
    }

    /**
     * Assign a role randomly,
     *
     * @param $starters pass-by-reference to keep it updated
     * @param $substitutes pass-by-reference to keep it updated
     */
    public function assignRole(&$starters, &$substitutes)
    {
        if ($starters > 0 && $substitutes > 0) {
            if (rand(1,2) == 1) {
                $this->setRole(PlayerRoleEnum::STARTER);
                $starters--;
            } else {
                $this->setRole(PlayerRoleEnum::SUBSTITUTE);
                $substitutes--;
            }
        } elseif ($starters > 0) {
            $this->setRole(PlayerRoleEnum::STARTER);
            $starters--;
        } else {
            $this->setRole(PlayerRoleEnum::SUBSTITUTE);
            $substitutes--;
        }
    }
}