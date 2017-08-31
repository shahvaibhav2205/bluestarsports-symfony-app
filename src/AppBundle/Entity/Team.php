<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 8/31/17
 * Time: 2:02 AM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class Team
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="team")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var Owner
     *
     * @ORM\OneToOne(targetEntity="Owner")
     * @JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var League
     *
     * @ORM\ManyToOne(targetEntity="League")
     * @JoinColumn(name="league_id", referencedColumnName="id")
     */
    protected $league;

    /**
     * @var Player[]
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team")
     */
    protected $players = [];

    /**
     * @ORM\Column(type="integer")
     */
    protected $capacity;

    /**
     * Team constructor.
     * @param $name
     * @param Owner $owner
     * @param League $league
     */
    public function __construct($name, Owner $owner, League $league)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->league = $league;
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
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param Owner $owner
     * @return Team
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return League
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param League $league
     * @return Team
     */
    public function setLeague($league)
    {
        $this->league = $league;
        return $this;
    }

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param Player[] $players
     * @return Team
     */
    public function setPlayers($players)
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     * @return Team
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }
}