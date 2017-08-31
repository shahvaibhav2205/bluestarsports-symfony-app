<?php
/**
 * Created by PhpStorm.
 * User: vaibhav
 * Date: 8/31/17
 * Time: 1:58 AM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Owner
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="owner")
 */
class Owner
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
     * Owner constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
     * @return Owner
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}