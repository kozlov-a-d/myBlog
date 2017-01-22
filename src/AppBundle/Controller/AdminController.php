<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 21.01.2017
 * Time: 13:45
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="admin_index")
     */
    public function indexAction()
    {

        return $this->render('admin.html.twig', array());

    }
}