<?php
// src/Colzak/EventBundle/Document/Team.php

namespace Colzak\EventBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @MongoDB\Document(repositoryClass="Colzak\EventBundle\Repository\TeamRepository")
 */
class Team
{
    const POOL_D2_A = "POOL_D2_A";
    const POOL_D2_B = "POOL_D2_B";
    const POOL_D2_C = "POOL_D2_C";
    const POOL_D2_D = "POOL_D2_D";
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $teamLogo;

    /**
     * @MongoDB\String
     */
    protected $teamLogoPath;

    /**
     * @MongoDB\String
     */
    protected $pool;

    /**
     * @MongoDB\Int
     */
    protected $point;

    /**
     * @MongoDB\Int
     */
    protected $gamePlayed;

    /**
     * @MongoDB\Int
     */
    protected $goalScored;

    /**
     * @MongoDB\Int
     */
    protected $goalLet;

    /**
     * @MongoDB\Int
     */
    protected $win;

    /**
     * @MongoDB\Int
     */
    protected $defeat;

    /**
     * @MongoDB\Int
     */
    protected $draw;

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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set teamLogoPath
     *
     * @param string $teamLogoPath
     * @return self
     */
    public function setTeamLogoPath($teamLogoPath)
    {
        $this->teamLogoPath = $teamLogoPath;
        return $this;
    }

    /**
     * Get teamLogoPath
     *
     * @return string $teamLogoPath
     */
    public function getTeamLogoPath()
    {
        return $this->teamLogoPath;
    }

    /**
     * Set pool
     *
     * @param string $pool
     * @return self
     */
    public function setPool($pool)
    {
        $this->pool = $pool;
        return $this;
    }

    /**
     * Get pool
     *
     * @return string $pool
     */
    public function getPool()
    {
        return $this->pool;
    }

    /**
     * Set point
     *
     * @param int $point
     * @return self
     */
    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }

    /**
     * Get point
     *
     * @return int $point
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set gamePlayed
     *
     * @param int $gamePlayed
     * @return self
     */
    public function setGamePlayed($gamePlayed)
    {
        $this->gamePlayed = $gamePlayed;
        return $this;
    }

    /**
     * Get gamePlayed
     *
     * @return int $gamePlayed
     */
    public function getGamePlayed()
    {
        return $this->gamePlayed;
    }

    /**
     * Set goalScored
     *
     * @param int $goalScored
     * @return self
     */
    public function setGoalScored($goalScored)
    {
        $this->goalScored = $goalScored;
        return $this;
    }

    /**
     * Get goalScored
     *
     * @return int $goalScored
     */
    public function getGoalScored()
    {
        return $this->goalScored;
    }

    /**
     * Set goalLet
     *
     * @param int $goalLet
     * @return self
     */
    public function setGoalLet($goalLet)
    {
        $this->goalLet = $goalLet;
        return $this;
    }

    /**
     * Get goalLet
     *
     * @return int $goalLet
     */
    public function getGoalLet()
    {
        return $this->goalLet;
    }

    /**
     * Set win
     *
     * @param int $win
     * @return self
     */
    public function setWin($win)
    {
        $this->win = $win;
        return $this;
    }

    /**
     * Get win
     *
     * @return int $win
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set defeat
     *
     * @param int $defeat
     * @return self
     */
    public function setDefeat($defeat)
    {
        $this->defeat = $defeat;
        return $this;
    }

    /**
     * Get defeat
     *
     * @return int $defeat
     */
    public function getDefeat()
    {
        return $this->defeat;
    }

    /**
     * Set draw
     *
     * @param int $draw
     * @return self
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
        return $this;
    }

    /**
     * Get draw
     *
     * @return int $draw
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Sets teamLogo.
     *
     * @param UploadedFile $teamLogo
     */
    public function setTeamLogo(UploadedFile $teamLogo = null)
    {
        $this->teamLogo = $teamLogo;
    }

    /**
     * Get teamLogo.
     *
     * @return UploadedFile
     */
    public function getTeamLogo()
    {
        return $this->teamLogo;
    }

    public function getAbsolutePath()
    {
        return null === $this->teamLogoPath
            ? null
            : $this->getUploadRootDir().'/'.$this->teamLogoPath;
    }

    public function getWebPath()
    {
        return null === $this->teamLogoPath
            ? null
            : $this->getUploadDir().'/'.$this->teamLogoPath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return '/uploads/teams/'.$this->getId().'/';
    }

    /**
     * @MongoDB\PostPersist()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getTeamLogo()) {
            return;
        }

        $fileExtension = $this->getTeamLogo()->guessExtension();

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getTeamLogo()->move(
            $this->getUploadRootDir(),
            $this->getId().'.'.$this->getTeamLogo()->guessExtension()
        );
        

        // set the path property to the filename where you've saved the file
        $this->teamLogoPath = $this->getUploadDir().$this->getId().'.'.$fileExtension;

        // clean up the file property as you won't need it anymore
        $this->teamLogo = null;
    }

    public static function getPoolList()
    {
        return array(
            self::POOL_D2_A => 'Poule D2 A',
            self::POOL_D2_B => 'Poule D2 B',
            self::POOL_D2_C => 'Poule D2 C',
            self::POOL_D2_D => 'Poule D2 D'
        );
    }
}
