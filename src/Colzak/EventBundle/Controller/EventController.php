<?php

namespace Colzak\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Colzak\EventBundle\Document\Team;

class EventController extends Controller
{
    public function gamesAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $paginator  = $this->get('knp_paginator');

        $q = $dm->createQueryBuilder('ColzakEventBundle:Game')
                ->sort('date', 'desc');
        $games = $q->getQuery()->execute()->toArray(false);

        $pagination = $paginator->paginate(
            $games,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('ColzakEventBundle:Game:games.html.twig', array('pagination' => $pagination));
    }

    public function nextGameAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $team = $dm->getRepository('ColzakEventBundle:Team')->find('531052e0d8291bca078b4568');
        // $game = $dm->getRepository('ColzakEventBundle:Game')->findOneBy(array('date'))
        $game = $dm->getRepository('ColzakEventBundle:Game')->getNextGame($team);

        // \Doctrine\Common\Util\Debug::dump($game);
        // die();
        return $this->render('ColzakEventBundle:Game:next_game.html.twig', array('game' => (null !== $game ? $game[0] : null)));
    }

    public function rankingAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $rankedTeams = $this->getRankedTeam();

        return $this->render('ColzakEventBundle:Team:rank.html.twig', array('rankedTeams' => $rankedTeams));
    }

    private function getRankedTeam() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $q = $dm->createQueryBuilder('ColzakEventBundle:Team')
                ->field('pool')->equals(Team::POOL_D2_C)
                ->field('enable')->equals(true)
                ->sort('point', 'desc')
                ->sort('name', 'asc');
        return $q->getQuery()->execute();
    }
}
