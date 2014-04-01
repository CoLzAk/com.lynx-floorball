<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\BlogBundle\Document\Article;
use Colzak\AdminBundle\Form\Type\AdminArticleFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminArticleController extends Controller {

    public function listAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $articles = $dm->getRepository('ColzakBlogBundle:Article')->findAll();
        $categories = $dm->getRepository('ColzakBlogBundle:Category')->findAll();
        return $this->render('ColzakAdminBundle:Article:list.html.twig', array('articles' => $articles, 'categories' => $categories));
    }

    public function newAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $article = new Article();
        $statusNew = $dm->getRepository('ColzakBlogBundle:Status')->findOneByCode("STATUS_NEW");
        $article->setStatus($statusNew);
        $dm->persist($article);
        $dm->flush();

        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_article_edit', array('id' => $article->getId())));
    }

    public function editAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $article = $dm->getRepository('ColzakBlogBundle:Article')->find($id);
        $statusPending = $dm->getRepository('ColzakBlogBundle:Status')->findOneByCode('STATUS_PENDING');

        $form = $this->get('form.factory')->create(new AdminArticleFormType(), $article);

        $request = $this->getRequest();

        if($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $article = $form->getData();
                $article->upload();
                (null !== $article->getStatus() ?: $article->setStatus($statusPending));
                $dm->persist($article);
                $dm->flush();
                return new RedirectResponse($this->container->get('router')->generate('colzak_admin_articles'));
            } else {
                var_dump($form->getErrorsAsString());
            }
        }

        return $this->render('ColzakAdminBundle:Article:edit.html.twig', array('form' => $form->createView(), 'article' => $article));
    }

    public function deleteAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $article = $dm->getRepository('ColzakBlogBundle:Article')->find($id);
        $dm->remove($article);
        $dm->flush();
        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_articles'));
    }
}
