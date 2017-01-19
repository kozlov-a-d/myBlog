<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.01.2017
 * Time: 23:00
 */

namespace BlogBundle\DataFixtures\ORM;


use BlogBundle\Entity\Category;
use BlogBundle\Entity\Posts;
use BlogBundle\Entity\Tags;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataLoad implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $category_1 = new Category();
        $category_1->setName("Others");

        $category_2 = new Category();
        $category_2->setName("FrontEnd");

        $category_3 = new Category();
        $category_3->setName("BackEnd");


        $tag_1 = new Tags();
        $tag_1->setName("HTML");

        $tag_2 = new Tags();
        $tag_2->setName("JS");

        $tag_3 = new Tags();
        $tag_3->setName("CSS");

        $tag_4 = new Tags();
        $tag_4->setName("PHP");


        $post_1 = new Posts();
        $post_1->setName("Hellow World");
        $post_1->setCategory($category_1);

        $post_2 = new Posts();
        $post_2->setName("About Bootstrap");
        $post_2->setCategory($category_2);

        $post_3 = new Posts();
        $post_3->setName("Js events");
        $post_3->setCategory($category_2);

        $post_4 = new Posts();
        $post_4->setName("Symfony 3.2 Route");
        $post_4->setCategory($category_3);

        $post_5 = new Posts();
        $post_5->setName("Jquery plugin: custom input[type='number']");
        $post_5->setCategory($category_2);

        $post_6 = new Posts();
        $post_6->setName("Symfony 3.2 Form");
        $post_6->setCategory($category_3);



        $manager->persist($post_1);
        $manager->persist($post_2);
        $manager->persist($post_3);
        $manager->persist($post_4);
        $manager->persist($post_5);
        $manager->persist($post_6);
        $manager->persist($category_1);
        $manager->persist($category_2);
        $manager->persist($category_3);
        $manager->persist($tag_1);
        $manager->persist($tag_2);
        $manager->persist($tag_3);
        $manager->persist($tag_4);
        $manager->flush();

    }
}