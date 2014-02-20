<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\UserBundle\Document\User;
use Colzak\AdminBundle\Form\Type\AdminUserFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminUserController extends Controller {

    public function listAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $users = $dm->getRepository('ColzakUserBundle:User')->findAll();
        return $this->render('ColzakAdminBundle:User:list.html.twig', array('users' => $users));
    }

    public function newAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $user = new User();
        $dm->persist($user);
        $dm->flush();

        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_user_edit', array('id' => $user->getId())));
    }

    public function editAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $user = $dm->getRepository('ColzakUserBundle:User')->find($id);

        $form = $this->get('form.factory')->create(new AdminUserFormType(), $user);

        $request = $this->getRequest();

        if($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $user = $form->getData();
                $user->upload();
                $dm->persist($user);
                $dm->flush();
                return new RedirectResponse($this->container->get('router')->generate('colzak_admin_users'));
            }
        }

        return $this->render('ColzakAdminBundle:User:edit.html.twig', array('form' => $form->createView(), 'user' => $user));
    }

    public function deleteAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $user = $dm->getRepository('ColzakUserBundle:User')->find($id);
        $dm->remove($user);
        $dm->flush();
        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_users'));
    }
}
