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
}
