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

    // Load a page from page name /page/{url}
    public function loadPageAction($url) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $article = $dm->getRepository('ColzakBlogBundle:Article')->findOneByUrl($url);
        return $this->render('ColzakBlogBundle:Article:pages.html.twig', array('article' => $article));
    }

    // get articles from categoryName
    private function getArticles($categoryName = 'news', $limit = null) {
        $sc = $this->get('security.context');
        $dm = $this->get('doctrine_mongodb')->getManager();
        $status = $dm->getRepository('ColzakBlogBundle:Status')->findOneBy(array('code' => 'STATUS_ONLINE'));
        $category = $dm->getRepository('ColzakBlogBundle:Category')->findOneBy(array('name' => $categoryName));
        $q = $dm->createQueryBuilder('ColzakBlogBundle:Article');
        $q->field('category')->references($category);
        ($sc->isGranted('ROLE_ADMIN') ?: $q->field('status')->references($status));
        $q->sort('createdAt', 'desc');
        (null === $limit ?: $q->limit($limit));
        return $q->getQuery()->execute();
    }
}
