<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakBlogBundle:Articles:index.html.twig');
    }
}
