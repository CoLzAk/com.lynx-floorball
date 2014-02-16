<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminDefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakAdminBundle:Default:index.html.twig');
    }
}
