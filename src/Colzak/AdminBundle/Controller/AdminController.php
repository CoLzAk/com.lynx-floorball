<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakAdminBundle:Admin:index.html.twig');
    }
}
