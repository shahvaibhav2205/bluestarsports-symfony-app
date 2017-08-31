<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 8/31/17
 * Time: 1:15 AM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class League
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="league")
 */
class League
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return League
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return League
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}