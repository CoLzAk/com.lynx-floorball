<?php

namespace Colzak\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\EventBundle\Document\Game;
use Colzak\AdminBundle\Form\Type\AdminGameFormType;
use Colzak\EventBundle\Document\Team;
use Colzak\AdminBundle\Form\Type\AdminTeamFormType;
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

        $form = $this->get('form.factory')->create(new AdminGameFormType(), $game);

        $request = $this->getRequest();

        if($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $game = $form->getData();
                $dm->persist($game);
                $dm->flush();
                return new RedirectResponse($this->container->get('router')->generate('colzak_admin_games'));
            }
        }

        return $this->render('ColzakAdminBundle:Event:edit_game.html.twig', array('form' => $form->createView(), 'game' => $game));
    }

    public function deleteGameAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $game = $dm->getRepository('ColzakEventBundle:Game')->find($id);

        $dm->remove($game);
        $dm->flush();
        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_games'));
    
    }

    public function listTeamsAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $teams = $dm->getRepository('ColzakEventBundle:Team')->findAll();
        return $this->render('ColzakAdminBundle:Event:list_teams.html.twig', array('teams' => $teams));
    }

    public function newTeamAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $team = new Team();
        $dm->persist($team);
        $dm->flush();

        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_team_edit', array('id' => $team->getId())));
    }

    public function editTeamAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $team = $dm->getRepository('ColzakEventBundle:Team')->find($id);

        $form = $this->get('form.factory')->create(new AdminTeamFormType(), $team);

        $request = $this->getRequest();

        if($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $team = $form->getData();
                $team->upload();
                $dm->persist($team);
                $dm->flush();
                return new RedirectResponse($this->container->get('router')->generate('colzak_admin_teams'));
            }
        }

        return $this->render('ColzakAdminBundle:Event:edit_team.html.twig', array('form' => $form->createView(), 'team' => $team));
    }

    public function deleteTeamAction($id) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $team = $dm->getRepository('ColzakEventBundle:Team')->find($id);

        $dm->remove($team);
        $dm->flush();
        return new RedirectResponse($this->container->get('router')->generate('colzak_admin_teams'));
    }
}
