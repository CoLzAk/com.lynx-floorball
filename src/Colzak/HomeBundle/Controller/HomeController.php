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
    		case 'what-is-floorball':
    			$templateName = 'what_is_floorball';
    			break;
            case 'about':
                $templateName = 'about';
                break;
            case 'club':
                $templateName = 'club';
                break;
    		default:
    			break;
    	}
        return $this->render('ColzakHomeBundle:Home:'.$templateName.'.html.twig');
    }
}
