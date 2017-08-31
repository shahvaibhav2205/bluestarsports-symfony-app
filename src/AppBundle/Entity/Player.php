<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 8/31/17
 * Time: 2:14 AM
 */

namespace AppBundle\Entity;


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
    const ROLE_STARTER      = "started";
    const ROLE_SUBSTITUTE   = "substitute";

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
     * Player constructor.
     * @param $team
     * @param $type
     */
    public function __construct($team, $type)
    {
        $this->team = $team;
        $this->type = $type;
    }

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
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return Player
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
}