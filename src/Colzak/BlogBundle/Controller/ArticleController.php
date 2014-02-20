<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColzakBlogBundle:Article:index.html.twig');
    }

    public function lastArticlesAction($categoryName = 'news') {
        $dm = $this->get('doctrine_mongodb')->getManager();

        //a tester
        $category = $dm->getRepository('ColzakBlogBundle:Category')->findOneBy(array('name' => $categoryName));
        $articles = $dm->createQueryBuilder('ColzakBlogBundle:Article')
                        ->field('category')->references($category)
                        ->limit(($categoryName == 'edito' ? 1 : 5))
                        ->getQuery()->execute();
        //fin test


        if ($categoryName == 'edito') {
            return $this->render('ColzakBlogBundle:Article:last_edito.html.twig', array('articles' => $articles));
        }
        return $this->render('ColzakBlogBundle:Article:last_articles.html.twig', array('articles' => $articles));
    }
}
