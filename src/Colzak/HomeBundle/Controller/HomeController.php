<?php

namespace Colzak\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\HomeBundle\Document\Message;
use Colzak\HomeBundle\Form\Type\ContactFormType;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakHomeBundle:Home:index.html.twig');
    }

    public function contactAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $message = new Message();
        $form = $this->get('form.factory')->create(new ContactFormType(), $message);

        return $this->render('ColzakHomeBundle:Home:contact.html.twig', array('form' => $form->createView()));
    }
}
