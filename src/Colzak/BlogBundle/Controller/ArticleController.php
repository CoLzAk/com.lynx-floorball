<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakBlogBundle:Article:index.html.twig');
    }

    public function lastArticlesAction($category = 'news') {
        $dm = $this->get('doctrine_mongodb')->getManager();

        //a tester
        $category = $dm->getRepository('ColzakBlogBundle:Category')->findOneBy(array('name' => 'news'));
        $articles = $dm->createQueryBuilder('ColzakBlogBundle:Article')
                        ->field('category')->references($category)
                        ->getQuery()->execute();
        //fin test

        $articles = $dm->getRepository('ColzakBlogBundle:Article')->findAll();
        if ($category == 'edito') {
            return $this->render('ColzakBlogBundle:Article:last_edito.html.twig', array('articles' => $articles));
        }
        return $this->render('ColzakBlogBundle:Article:last_articles.html.twig', array('articles' => $articles));
    }
}
