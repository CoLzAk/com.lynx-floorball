<?php

namespace Colzak\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
    	$dm = $this->get('doctrine_mongodb')->getManager();
    	$users = $dm->getRepository('ColzakUserBundle:User')->findAll();
        return $this->render('ColzakUserBundle:User:index.html.twig', array('users' => $users));
    }
}
