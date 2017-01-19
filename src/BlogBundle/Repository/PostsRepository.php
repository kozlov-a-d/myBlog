<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 15.01.2017
 * Time: 21:56
 */

namespace BlogBundle\Repository;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostsRepository")
 */
class PostsRepository extends EntityRepository
{

}