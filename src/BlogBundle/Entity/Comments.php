<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 22.01.2017
 * Time: 14:42
 */

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Posts
 * @package BlogBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comments
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
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

//    /**
//     * Many Comments have One Post.
//     * @ORM\ManyToOne(targetEntity="Posts", inversedBy="comments")
//     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
//     */
//    private $posts;

    /**
     * @ORM\Column(type="integer")
     */
    private $post_id;

    public function __construct()
    {
        $this->created = new \DateTime();
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
     * @return Comments
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comments
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Comments
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set posts
     *
     * @param \BlogBundle\Entity\Posts $posts
     *
     * @return Comments
     */
    public function setPosts(\BlogBundle\Entity\Posts $posts = null)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get posts
     *
     * @return \BlogBundle\Entity\Posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     *
     * @return Comments
     */
    public function setPostId($postId)
    {
        $this->post_id = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer
     */
    public function getPostId()
    {
        return $this->post_id;
    }
}
