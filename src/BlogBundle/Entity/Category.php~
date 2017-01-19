<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.01.2017
 * Time: 19:47
 */

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package BlogBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * One Category has Many Posts.
     * @ORM\OneToMany(targetEntity="Posts", mappedBy="category")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

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
     * @return Category
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

    /**
     * Add post
     *
     * @param \BlogBundle\Entity\Posts $post
     *
     * @return Category
     */
    public function addPost(\BlogBundle\Entity\Posts $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \BlogBundle\Entity\Posts $post
     */
    public function removePost(\BlogBundle\Entity\Posts $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    public function __toString() {
        return $this->name;
    }
}
