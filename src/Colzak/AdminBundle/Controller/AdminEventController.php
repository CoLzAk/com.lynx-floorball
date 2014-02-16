<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\EventBundle\Document\Game;
use Colzak\AdminBundle\Form\Type\AdminGameFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminEventController extends Controller {

    public function listGamesAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $games = $dm->getRepository('ColzakEventBundle:Game')->findAll();
        return $this->render('ColzakAdminBundle:Event:list_games.html.twig', array('games' => $games));
    }

    public function newGameAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $game = new Game();
        $dm->persist($game);
        $dm->flush();

        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_game_edit', array('id' => $game->getId())));
    }

    public function editGameAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $game = $dm->getRepository('ColzakEventBundle:Game')->find($id);
        // $statusPending = $dm->getRepository('ColzakBlogBundle:Status')->findOneByCode('STATUS_PENDING');

        $form = $this->get('form.factory')->create(new AdminGameFormType(), $game);

        $request = $this->getRequest();

        if($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $game = $form->getData();
                // $article->upload();
                // $article->setStatus($statusPending);
                $dm->persist($game);
                $dm->flush();
                return new RedirectResponse($this->container->get('router')->generate('colzak_admin_games'));
            }
        }

        return $this->render('ColzakAdminBundle:Event:edit_game.html.twig', array('form' => $form->createView()));
    }
}
