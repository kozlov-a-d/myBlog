<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.01.2017
 * Time: 19:50
 */

namespace BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Category;
use BlogBundle\Entity\Posts;
use BlogBundle\Entity\Tags;
use Symfony\Component\HttpFoundation\Request;


/**
 * Post controller.
 *
 * @Route("blog")
 */
class BlogController extends Controller
{

    /**
     * @Route("/", name="blog_index")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BlogBundle:Posts')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $this->render('BlogBundle:Blog:index.html.twig', array(
            'posts' => $result,
        ));

    }

    /**
     * @Route("/post/{id}", name="blog_show_post")
     * @Method("GET")
     */
    public function showAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Posts')->find($id);

        return $this->render('BlogBundle:Blog:index.html.twig', array(
            'post' => $post,
            'heading' => $post->getName(),
        ));

    }

    /**
     * @Route("/category/{id}", name="blog_post_by_category", requirements={"page": "\d+"})
     */
    public function listPostsByCategoryAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Posts')->findBy(array('category' => $id));

        $category = $em->getRepository('BlogBundle:Category')->find($id);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $this->render('BlogBundle:Blog:index.html.twig', array(
            'posts' => $result,
            'heading' => $category->getName(),
            'categoryCurrId' => $category->getId(),
        ));

    }

    /**
     * @Route("/tag/{id}", name="blog_post_by_tag", requirements={"id": "\d+"})
     */
    public function listPostsByTagAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Posts');

        $query = $repository->createQueryBuilder('u')
            ->innerJoin('u.tags', 'g')
            ->where('g.id = :tags_id')
            ->setParameter('tags_id', $id)
            ->getQuery()->getResult();

        $posts = $query;

        $tag = $em->getRepository('BlogBundle:Tags')->find($id);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );


        return $this->render('BlogBundle:Blog:index.html.twig', array(
            'posts' => $result,
            'heading' => $tag->getName(),
            'tagsCurrId' => $tag->getId(),
        ));

    }

    /**
     * @Route("/posts/")
     */
    public function listPostsAction($posts)
    {
        return $this->render('BlogBundle:Blog:list.html.twig', array(
            'posts' => $posts,
        ));
    }

    /**
     * @Route("/list_category/{currId}", defaults={"currId": "0"})
     */
    public function listCategoryAction($currId)
    {

        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('BlogBundle:Category')->findAll();

        return $this->render('BlogBundle:Blog:listCategory.html.twig', array(
            'categories' => $category,
            'currId' => $currId,
        ));

    }
    /**
     * @Route("/list_tags/", defaults={"currId": "0"})
     */
    public function listTagsAction($currId)
    {

        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('BlogBundle:Tags')->findAll();


        return $this->render('BlogBundle:Blog:listTags.html.twig', array(
            'tags' => $tags,
            'currId' => $currId,
        ));

    }

    /**
     * @Route("/addTestData")
     */
    public function addTestDataAction($id)
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
        $post_1->addTag($tag_1);

        $post_2 = new Posts();
        $post_2->setName("About Bootstrap");
        $post_2->setCategory($category_2);
        $post_2->addTag($tag_1);
        $post_2->addTag($tag_2);
        $post_2->addTag($tag_3);

        $post_3 = new Posts();
        $post_3->setName("Js events");
        $post_3->setCategory($category_2);
        $post_3->addTag($tag_2);

        $post_4 = new Posts();
        $post_4->setName("Symfony 3.2 Route");
        $post_4->setCategory($category_3);
        $post_4->addTag($tag_4);

        $post_5 = new Posts();
        $post_5->setName("Jquery plugin: custom input[type='number']");
        $post_5->setCategory($category_2);
        $post_5->addTag($tag_1);
        $post_5->addTag($tag_2);

        $post_6 = new Posts();
        $post_6->setName("Symfony 3.2 Form");
        $post_6->setCategory($category_3);
        $post_6->addTag($tag_1);
        $post_6->addTag($tag_2);
        $post_6->addTag($tag_4);

        $em = $this->getDoctrine()->getManager();
        $em->persist($post_1);
        $em->persist($post_2);
        $em->persist($post_3);
        $em->persist($post_4);
        $em->persist($post_5);
        $em->persist($post_6);
        $em->persist($category_1);
        $em->persist($category_2);
        $em->persist($category_3);
        $em->persist($tag_1);
        $em->persist($tag_2);
        $em->persist($tag_3);
        $em->persist($tag_4);
        $em->flush();

        return $this->render('index.html.twig', array(
            'heading' => 'Добавили тестовые значения',
            'posts' => false
        ));

    }

}