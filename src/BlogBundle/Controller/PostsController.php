<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post controller.
 *
 * @Route("posts")
 */
class PostsController extends Controller
{
    /**
     * Lists all post entities.
     *
     * @Route("/", name="posts_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Posts')->findAll();

        return $this->render('posts/index.html.twig', array(
            'posts' => $posts,
        ));
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/new", name="posts_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $post = new Posts();
        $form = $this->createForm('BlogBundle\Form\PostsType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('posts_show', array('id' => $post->getId()));
        }

        return $this->render('posts/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/{id}", name="posts_show")
     * @Method("GET")
     */
    public function showAction(Posts $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('posts/show.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing post entity.
     *
     * @Route("/{id}/edit", name="posts_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Posts $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('BlogBundle\Form\PostsType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('posts_edit', array('id' => $post->getId()));
        }

        return $this->render('posts/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     * @Route("/{id}", name="posts_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Posts $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush($post);
        }

        return $this->redirectToRoute('posts_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Posts $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Posts $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('posts_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
