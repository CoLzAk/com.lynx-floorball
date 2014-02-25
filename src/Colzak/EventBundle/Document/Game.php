<?php
// src/Colzak/EventBundle/Document/Game.php

namespace Colzak\EventBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Colzak\EventBundle\Repository\GameRepository")
 */
class Game
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Team")
     */
    protected $team1;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Team")
     */
    protected $team2;

    /**
     * @MongoDB\String
     */
    protected $place;

    /**
     * @MongoDB\Date
     */
    protected $date;

    /**
     * @MongoDB\Int
     */
    protected $team1Score;

    /**
     * @MongoDB\Int
     */
    protected $team2Score;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set team1
     *
     * @param Colzak\EventBundle\Document\Team $team1
     * @return self
     */
    public function setTeam1(\Colzak\EventBundle\Document\Team $team1)
    {
        $this->team1 = $team1;
        return $this;
    }

    /**
     * Get team1
     *
     * @return Colzak\EventBundle\Document\Team $team1
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param Colzak\EventBundle\Document\Team $team2
     * @return self
     */
    public function setTeam2(\Colzak\EventBundle\Document\Team $team2)
    {
        $this->team2 = $team2;
        return $this;
    }

    /**
     * Get team2
     *
     * @return Colzak\EventBundle\Document\Team $team2
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return self
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * Get place
     *
     * @return string $place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set team1Score
     *
     * @param int $team1Score
     * @return self
     */
    public function setTeam1Score($team1Score)
    {
        $this->team1Score = $team1Score;
        return $this;
    }

    /**
     * Get team1Score
     *
     * @return int $team1Score
     */
    public function getTeam1Score()
    {
        return $this->team1Score;
    }

    /**
     * Set team2Score
     *
     * @param int $team2Score
     * @return self
     */
    public function setTeam2Score($team2Score)
    {
        $this->team2Score = $team2Score;
        return $this;
    }

    /**
     * Get team2Score
     *
     * @return int $team2Score
     */
    public function getTeam2Score()
    {
        return $this->team2Score;
    }
}
