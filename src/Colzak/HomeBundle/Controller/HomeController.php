<?php

namespace Colzak\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\HomeBundle\Document\Message;
use Colzak\HomeBundle\Form\Type\ContactFormType;

class HomeController extends Controller
{
    public function indexAction()
    {
        // return $this->render('ColzakHomeBundle:Home:index.html.twig');
        return $this->render('ColzakHomeBundle:Home:single_scroll.html.twig');
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

    public function contactAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $message = new Message();
        $form = $this->get('form.factory')->create(new ContactFormType(), $message);

        return $this->render('ColzakHomeBundle:Home:contact.html.twig', array('form' => $form->createView()));
    }
}
