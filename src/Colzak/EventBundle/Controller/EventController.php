<?php

namespace Colzak\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function gamesAction()
    {
    	$dm = $this->get('doctrine_mongodb')->getManager();
    	$games = $dm->getRepository('ColzakEventBundle:Game')->findAll();
        return $this->render('ColzakEventBundle:Game:games.html.twig', array('games' => $games));
    }

    public function nextGameAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        // $game = $dm->getRepository('ColzakEventBundle:Game')->findOneBy(array('date'))
        $game = $dm->getRepository('ColzakEventBundle:Game')->getNextGame();
        return $this->render('ColzakEventBundle:Game:next_game.html.twig', array('game' => $game));
    }

    public function rankingAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $rankedTeams = $this->getRankedTeam();

        return $this->render('ColzakEventBundle:Team:rank.html.twig', array('rankedTeams' => $rankedTeams));
    }

    private function getRankedTeam() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $q = $dm->createQueryBuilder('ColzakEventBundle:Team')
                ->sort('point', 'desc');
        return $q->getQuery()->execute();
    }
}
