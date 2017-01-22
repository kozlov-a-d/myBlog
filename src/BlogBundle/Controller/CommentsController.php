<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 22.01.2017
 * Time: 14:51
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\Comments;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Comments controller.
 *
 * @Route("blog")
 */
class CommentsController extends Controller
{
    /**
     * @Route("/post/{id}/comments/", name="blog_post_show_comments")
     * @Method("GET")
     */
    public function showCommentsByPostAction($id){
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('BlogBundle:Comments')->findBy(array('post_id'=>$id), array('created' => 'DESC'));

        return $this->render('BlogBundle:Blog:listComments.html.twig', array(
            'comments' => $comments,
        ));
    }

    /**
     * Creates a new comment entity.
     *
     * @Route("/post/{id}/comments/new", name="blog_post_add_comments")
     * @Method({"GET", "POST"})
     */
    public function AddCommentByPostAction(Request $request, $id){

        $comment = new Comments();
        $form = $this->createForm('BlogBundle\Form\CommentsType', $comment);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush($comment);

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Ваш комментарий успешно отправлен.')
            ;

            $isAjax=null;
            $isAjax=$request->isXmlHttpRequest();

            if(!$isAjax){
                return $this->redirectToRoute('blog_show_post', array('id' => $id));
            }

        }

        return $this->render('BlogBundle:Blog:addComment.html.twig', array(
            'comment' => $comment,
            'id' => $id,
            'form' => $form->createView(),
        ));

    }
}