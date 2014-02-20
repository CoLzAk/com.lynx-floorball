<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function articlesAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $articles = $this->getLastArticles('news');
        return $this->render('ColzakBlogBundle:Article:articles.html.twig', array('articles' => $articles));
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

    public function mediaAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $category = $dm->getRepository('ColzakBlogBundle:Category')->findOneBy(array('name' => 'media'));

        $media = $dm->createQueryBuilder('ColzakBlogBundle:Article')
                        ->field('category')->references($category)
                        ->getQuery()->execute();

        return $this->render('ColzakBlogBundle:Article:media.html.twig', array('media' => $media));
    }

    private function getLastArticles($categoryName = 'news', $limit = null) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $category = $dm->getRepository('ColzakBlogBundle:Category')->findOneBy(array('name' => $categoryName));
        $q = $dm->createQueryBuilder('ColzakBlogBundle:Article')
                        ->field('category')->references($category);
        (null === $limit ?: $q->limit($limit));
        return $q->getQuery()->execute();
    }
}
