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
     * @var Player[]
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team", cascade={"persist", "remove"}, orphanRemoval=true)
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
     * @param int $capacity
     */
    public function __construct($name, Owner $owner, $capacity = 0)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->capacity = $capacity;
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
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param integer $capacity
     * @return Team
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->getPlayers()[] = $player;
    }

    /**
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        if (!$this->players->contains($player)) {
            return;
        }
        $this->players->removeElement($player);
        $player->setTeam(null);
    }

    /**
     * @param Player $player
     * @return bool
     */
    public function isValidPlayer(Player $player)
    {
        if ($this->getCapacity() == 0) {
            return true;
        }
        foreach ($this->getPlayers() as $teamPlayer) {

            if ($player->getName() === $teamPlayer->getName()) {
                return false;
            } elseif ($player->getTotalAttributeScore() == $teamPlayer->getTotalAttributeScore()) {
                return false;
            } elseif ($player->getSalary() > 175) {
                return false;
            }
            return true;
        }
    }
}