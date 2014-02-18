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
    protected $opponent;

    /**
     * @MongoDB\String
     */
    protected $place;

    /**
     * @MongoDB\Date
     */
    protected $date;

    /**
     * @MongoDB\Boolean
     */
    protected $inHome; //match a domicile

    /**
     * @MongoDB\Int
     */
    protected $score;

    /**
     * @MongoDB\Int
     */
    protected $opponentScore;

    /**
     * @MongoDB\ReferenceOne(targetDocument="GameStatus")
     */
    protected $gameStatus;

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
     * Set inHome
     *
     * @param boolean $inHome
     * @return self
     */
    public function setInHome($inHome)
    {
        $this->inHome = $inHome;
        return $this;
    }

    /**
     * Get inHome
     *
     * @return boolean $inHome
     */
    public function getInHome()
    {
        return $this->inHome;
    }

    /**
     * Set score
     *
     * @param int $score
     * @return self
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * Get score
     *
     * @return int $score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set opponentScore
     *
     * @param int $opponentScore
     * @return self
     */
    public function setOpponentScore($opponentScore)
    {
        $this->opponentScore = $opponentScore;
        return $this;
    }

    /**
     * Get opponentScore
     *
     * @return int $opponentScore
     */
    public function getOpponentScore()
    {
        return $this->opponentScore;
    }

    /**
     * Set gameStatus
     *
     * @param Colzak\EventBundle\Document\GameStatus $gameStatus
     * @return self
     */
    public function setGameStatus(\Colzak\EventBundle\Document\GameStatus $gameStatus)
    {
        $this->gameStatus = $gameStatus;
        return $this;
    }

    /**
     * Get gameStatus
     *
     * @return Colzak\EventBundle\Document\GameStatus $gameStatus
     */
    public function getGameStatus()
    {
        return $this->gameStatus;
    }

    /**
     * Set opponent
     *
     * @param Colzak\EventBundle\Document\Team $opponent
     * @return self
     */
    public function setOpponent(\Colzak\EventBundle\Document\Team $opponent)
    {
        $this->opponent = $opponent;
        return $this;
    }

    /**
     * Get opponent
     *
     * @return Colzak\EventBundle\Document\Team $opponent
     */
    public function getOpponent()
    {
        return $this->opponent;
    }
}
