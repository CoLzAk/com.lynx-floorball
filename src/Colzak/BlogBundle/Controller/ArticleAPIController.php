<?php

namespace Colzak\BlogBundle\Controller;

use FOS\RestBundle\Util\Codes;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\RouteRedirectView;

use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ODM\MongoDB\DocumentManager;

use Colzak\BlogBundle\Document\Article;


/**
 * Rest controller for notes
 *
 * @package Colzak\BlogBundle\Controller
 * @author Joel Lauret <joel.lauret@gmail.com>
 */
class ArticleAPIController extends FOSRestController
{
    /**
     * return \KNP\PaginatorBundle\Paginator
     */
    public function getPaginator()
    {
        return $this->get('knp_paginator');
    }

    /**
     * return \Doctrine\MongoDB\DocumentManager
     */
    public function getArticleManager()
    {
        return $this->get('doctrine_mongodb')->getManager()->getRepository('ColzakBlogBundle:Article');
    }

    /**
     * return \Doctrine\MongoDB\DocumentManager
     */
    public function getColzakUserManager()
    {
        return $this->get('doctrine_mongodb')->getManager()->getRepository('ColzakUserBundle:User');
    }

    /**
     * List all articles.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     *
     * @return array
     */
    public function getArticlesAction(Request $request)
    {
        $articles = $this->getArticleManager()->findAll();
        $paginator = $this->getPaginator();

        $pagination = $paginator->paginate(
            $articles,
            $this->get('request')->query->get('page', 1)/*page number*/,
            15 //number of elements per page
        );

        return $pagination;
    }

    /**
     * Get a single article.
     *
     * @ApiDoc(
     *   output = "Colzak\BlogBundle\Document\Article",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the article is not found"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @param Request $request the request object
     * @param string  $url     the article url
     *
     * @return array
     *
     * @throws NotFoundHttpException when article not exist
     */
    public function getArticleAction(Request $request, $url)
    {
        $article = $this->getArticleManager()->findOneBy(array('url' => $url)); //Change to other function to retrieve only necessary informations
        if (null === $article) {
            throw $this->createNotFoundException("Article not found.");
        }

        $view = new View($article);
        $group = $this->get('security.context')->isGranted('ROLE_API') ? 'restapi' : 'standard';
        $view->getSerializationContext()->setGroups(array('Default', $group));

        return $view;
    }
}
