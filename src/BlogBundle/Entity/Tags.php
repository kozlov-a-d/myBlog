<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.01.2017
 * Time: 19:47
 */

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tags
 * @package BlogBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="tags")
 */
class Tags
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;






    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tags
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString() {
        return $this->name;
    }
}
