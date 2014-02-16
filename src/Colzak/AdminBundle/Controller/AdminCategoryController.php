<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\BlogBundle\Document\Category;
use Colzak\AdminBundle\Form\Type\AdminCategoryFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminCategoryController extends Controller {

    public function listAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $categories = $dm->getRepository('ColzakBlogBundle:Category')->findAll();
        return $this->render('ColzakAdminBundle:Category:list.html.twig', array('categories' => $categories));
    }

    public function newAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $request = $this->getRequest();
        $category = new Category();

        $form = $this->get('form.factory')->create(new AdminCategoryFormType(), $category);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $category = $form->getData();
                $dm->persist($category);
                $dm->flush();

                return new RedirectResponse($this->container->get('router')->generate('colzak_admin_categories'));
            }
            
        }

        return $this->render('ColzakAdminBundle:Category:new.html.twig', array('form' => $form->createView()));
    }
}
