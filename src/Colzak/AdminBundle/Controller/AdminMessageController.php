<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\BlogBundle\Document\Category;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminMessageController extends Controller {

    public function listAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $messages = $dm->getRepository('ColzakHomeBundle:Message')->findAll();
        return $this->render('ColzakAdminBundle:Message:list.html.twig', array('messages' => $messages));
    }

    public function readAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $message = $dm->getRepository('ColzakHomeBundle:Message')->find($id);
        if (false === $message->getIsRead()) {
            $message->setIsRead(true);
            $dm->persist($message);
            $dm->flush();
        }
        return $this->render('ColzakAdminBundle:Message:read.html.twig', array('message' => $message));
    }


    public function deleteAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $category = $dm->getRepository('ColzakBlogBundle:Category')->find($id);

        $dm->remove($category);
        $dm->flush();
        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_categories'));
    }
}
