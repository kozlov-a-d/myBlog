<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 15.01.2017
 * Time: 22:58
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
 * @Route("admin/blog")
 */
class AdminBlogController extends Controller
{
    /**
     * @Route("/", name="admin_blog")
     */
    public function indexAction(Request $request)
    {

        return $this->render('BlogBundle:AdminBlog:index.html.twig', array());

    }

    /*
     * Posts Actions
     */

    /**
     * @Route("/posts/", name="admin_blog_list_posts")
     */
    public function listPostsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository('BlogBundle:Posts')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $result,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 20)
        );

        return $this->render('BlogBundle:AdminBlog:listPosts.html.twig', array(
            'posts' => $posts,
        ));

    }

    /**
     * Creates a new post entity.
     *
     * @Route("/posts/new", name="admin_blog_posts_new")
     * @Method({"GET", "POST"})
     */
    public function newPostsAction(Request $request)
    {
        $post = new Posts();
        $form = $this->createForm('BlogBundle\Form\PostsType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('admin_blog_list_posts');
        }

        return $this->render('BlogBundle:AdminBlog:newPosts.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/posts/{id}/edit", name="admin_blog_posts_edit")
     * @Method({"GET", "POST"})
     */
    public function editPostsAction(Request $request, Posts $post)
    {
        $editForm = $this->createForm('BlogBundle\Form\PostsType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_blog_list_posts');
        }

        return $this->render('BlogBundle:AdminBlog:editPosts.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
        ));

    }

    /**
     * @param Request  $request
     * @param Posts $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/posts/{id}/delete", name="admin_blog_posts_delete")
    */
    public function deletePostAction(Request $request, Posts $post)
    {
        if ($post === null) {
            return $this->redirectToRoute('list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('admin_blog_list_posts');
    }

    /*
     * Category Actions
     */

    /**
     * @Route("/category/", name="admin_blog_list_category")
     */
    public function listCategoryAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository('BlogBundle:Category')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $categories = $paginator->paginate(
            $result,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 20)
        );

        return $this->render('BlogBundle:AdminBlog:listCategory.html.twig', array(
            'categories' => $categories,
        ));

    }

    /**
     * Creates a new post entity.
     *
     * @Route("/category/new", name="admin_blog_category_new")
     * @Method({"GET", "POST"})
     */
    public function newCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('BlogBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush($category);

            return $this->redirectToRoute('admin_blog_list_category');
        }

        return $this->render('BlogBundle:AdminBlog:editCategory.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
            'new' => true,
        ));
    }

    /**
     * @Route("/category/{id}/edit", name="admin_blog_category_edit")
     * @Method({"GET", "POST"})
     */
    public function editCategoryAction(Request $request, Category $category)
    {
        $form = $this->createForm('BlogBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_blog_list_category');
        }

        return $this->render('BlogBundle:AdminBlog:editCategory.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));

    }

    /**
     * @param Request  $request
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/category/{id}/delete", name="admin_blog_category_delete")
     */
    public function deleteCategoryAction(Request $request, Category $category)
    {
        if ($category === null) {
            return $this->redirectToRoute('list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('admin_blog_list_category');
    }


    /*
     * Tags Actions
     */

    /**
     * @Route("/tags/", name="admin_blog_list_tags")
     */
    public function listTagsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository('BlogBundle:Tags')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $tags = $paginator->paginate(
            $result,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 20)
        );

        return $this->render('BlogBundle:AdminBlog:listTags.html.twig', array(
            'tags' => $tags,
        ));

    }

    /**
     * Creates a new post entity.
     *
     * @Route("/tags/new", name="admin_blog_tag_new")
     * @Method({"GET", "POST"})
     */
    public function newTagsAction(Request $request)
    {
        $tag = new Tags();
        $form = $this->createForm('BlogBundle\Form\TagsType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush($tag);

            return $this->redirectToRoute('admin_blog_list_tags');
        }

        return $this->render('BlogBundle:AdminBlog:editTag.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
            'new' => true,
        ));
    }

    /**
     * @Route("/tags/{id}/edit", name="admin_blog_tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editTagAction(Request $request, Tags $tag)
    {
        $form = $this->createForm('BlogBundle\Form\TagsType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_blog_list_tags');
        }

        return $this->render('BlogBundle:AdminBlog:editTag.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
        ));

    }

    /**
     * @param Request  $request
     * @param Tags $tag
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/tags/{id}/delete", name="admin_blog_tag_delete")
     */
    public function deleteTagAction(Request $request, Tags $tag)
    {
        if ($tag === null) {
            return $this->redirectToRoute('list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($tag);
        $em->flush();

        return $this->redirectToRoute('admin_blog_list_tags');
    }

}