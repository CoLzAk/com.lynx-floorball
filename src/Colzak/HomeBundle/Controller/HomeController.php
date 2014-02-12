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
        return $this->render('ColzakHomeBundle:Home:'.$name.'.html.twig');
    }
}
