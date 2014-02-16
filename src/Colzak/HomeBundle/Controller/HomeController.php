<?php

namespace Colzak\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakHomeBundle:Home:index.html.twig');
    }

    public function loadPageAction($name) {
    	$dm = $this->get('doctrine_mongodb')->getManager();
    	switch ($name) {
    		case 'team':
    			$data = $dm->getRepository('ColzakUserBundle:User')->findAll();
    			break;
    		
    		default:
    			# code...
    			break;
    	}
        return $this->render('ColzakHomeBundle:Home:'.$name.'.html.twig', array('data' => $data));
    }
}
