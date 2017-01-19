<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.01.2017
 * Time: 23:42
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AppController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {

        return $this->render('base.html.twig', array());

    }

}