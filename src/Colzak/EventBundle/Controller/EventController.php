<?php

namespace Colzak\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function gamesAction()
    {
    	$dm = $this->get('doctrine_mongodb')->getManager();
    	$games = $dm->getRepository('ColzakEventBundle:Game')->findAll();
        return $this->render('ColzakEventBundle:Game:index.html.twig', array('games' => $games));
    }

    public function nextGameAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $game = $dm->getRepository('ColzakEventBundle:Game')->getNextGame();
        return $this->render('ColzakEventBundle:Game:next_game.html.twig', array('game' => $game));
    }
}
