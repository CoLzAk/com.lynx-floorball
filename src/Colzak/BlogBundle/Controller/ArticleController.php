<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakBlogBundle:Article:index.html.twig');
    }

    public function lastArticlesAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $articles = $dm->getRepository('ColzakBlogBundle:Article')->getLastArticles();
        return $this->render('ColzakBlogBundle:Article:last_articles.html.twig', array('articles' => $articles));
    }
}
