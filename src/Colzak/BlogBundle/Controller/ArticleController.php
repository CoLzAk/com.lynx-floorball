<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function articlesAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $articles = $this->getArticles('news');
        return $this->render('ColzakBlogBundle:Article:articles.html.twig', array('articles' => $articles));
    }

    public function lastArticlesAction($categoryName = 'news') {
        $dm = $this->get('doctrine_mongodb')->getManager();

        switch ($categoryName) {
            case 'news':
                $templateName = 'last_articles';
                $limit = 5;
                break;
            case 'edito':
                $templateName = 'last_edito';
                $limit = 1;
                break;
            case 'pages':
                $templateName = 'pages';
                $limit = null;
            default:
                $templateName = 'last_articles';
                $limit = 5;
                break;
        }
        $articles = $this->getArticles($categoryName, $limit);
        return $this->render('ColzakBlogBundle:Article:'.$templateName.'.html.twig', array('articles' => $articles));
    }

    public function mediaAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $media = $this->getArticles('media');
        return $this->render('ColzakBlogBundle:Article:media.html.twig', array('media' => $media));
    }

    // Todo
    // Move code above below

    // Display the 'static' pages preview on homepage 
    // Not used yet
    public function pagesPreviewAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $previews = $this->getArticles('pages');
        return $this->render('ColzakBlogBundle:Article:pages_preview.html.twig', array('previews' => $previews));
    }

    // Load a page from page name /page/{name}
    public function loadPageAction($name) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $article = $dm->getRepository('ColzakBlogBundle:Article')->findOneByTitle($name);
        return $this->render('ColzakBlogBundle:Article:pages.html.twig', array('article' => $article));
    }

    // get articles from categoryName
    private function getArticles($categoryName = 'news', $limit = null) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $category = $dm->getRepository('ColzakBlogBundle:Category')->findOneBy(array('name' => $categoryName));
        $q = $dm->createQueryBuilder('ColzakBlogBundle:Article')
                ->field('category')->references($category)
                ->sort('createdAt', 'desc');
            (null === $limit ?: $q->limit($limit));
        return $q->getQuery()->execute();
    }
}
