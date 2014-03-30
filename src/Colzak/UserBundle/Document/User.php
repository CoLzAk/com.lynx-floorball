<?php
// src/Colzak/UserBundle/Document/User.php

namespace Colzak\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @MongoDB\Document(repositoryClass="Colzak\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    // POSITIONS
    const POSITION_GOAL_KEEPER = 'GOAL_KEEPER';
    const POSITION_DEFENSE = 'DEFENSE';
    const POSITION_LEFT_DEFENSE = 'LEFT_DEFENSE';
    const POSITION_RIGHT_DEFENSE = 'RIGHT_DEFENSE';
    const POSITION_CENTER = 'CENTER';
    const POSITION_LEFT_WING = 'LEFT_WING';
    const POSITION_RIGHT_WING = 'RIGHT_WING';
    const POSITION_STRIKE = 'STRIKE';

    // ROLES
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $firstname;

    /**
     * @MongoDB\String
     */
    protected $lastname;

    /**
     * @MongoDB\String
     */
    protected $nickname;

    /**
     * @MongoDB\String
     */
    protected $position;

    /**
     * @MongoDB\Int
     */
    protected $number;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $userPicture;

    /**
     * @MongoDB\String
     */
    protected $userPicturePath;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Set firstname
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set surname
     *
     * @param string $nickname
     * @return self
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * Get nickname
     *
     * @return string $nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return string $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set number
     *
     * @param int $number
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return int $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set userPicturePath
     *
     * @param string $userPicturePath
     * @return self
     */
    public function setUserPicturePath($userPicturePath)
    {
        $this->userPicturePath = $userPicturePath;
        return $this;
    }

    /**
     * Get userPicturePath
     *
     * @return string $userPicturePath
     */
    public function getUserPicturePath()
    {
        return $this->userPicturePath;
    }

    /**
     * Sets userPicture.
     *
     * @param UploadedFile $userPicture
     */
    public function setUserPicture(UploadedFile $userPicture = null)
    {
        $this->userPicture = $userPicture;
    }

    /**
     * Get userPicture.
     *
     * @return UploadedFile
     */
    public function getUserPicture()
    {
        return $this->userPicture;
    }

    public function getAbsolutePath()
    {
        return null === $this->userPicturePath
            ? null
            : $this->getUploadRootDir().'/'.$this->userPicturePath;
    }

    public function getWebPath()
    {
        return null === $this->userPicturePath
            ? null
            : $this->getUploadDir().'/'.$this->userPicturePath;
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
        return '/uploads/users/'.$this->getId().'/';
    }

    /**
     * @MongoDB\PostPersist()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getUserPicture()) {
            return;
        }

        $fileExtension = $this->getUserPicture()->guessExtension();

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getUserPicture()->move(
            $this->getUploadRootDir(),
            $this->getId().'.'.$this->getUserPicture()->guessExtension()
        );
        

        // set the path property to the filename where you've saved the file
        $this->userPicturePath = $this->getUploadDir().$this->getId().'.'.$fileExtension;

        // clean up the file property as you won't need it anymore
        $this->userPicture = null;
    }

    public static function getPositionList()
    {
        return array(
            self::POSITION_GOAL_KEEPER => 'Gardien',
            self::POSITION_DEFENSE => 'Défenseur',
            self::POSITION_RIGHT_DEFENSE => 'Défenseur droit',
            self::POSITION_LEFT_DEFENSE => 'Défenseur gauche',
            self::POSITION_CENTER => 'Centre',
            self::POSITION_RIGHT_WING => 'Ailier droit',
            self::POSITION_LEFT_WING => 'Ailier gauche',
            self::POSITION_STRIKE => 'Attaquant'
        );
    }

    public static function getRoleList()
    {
        return array(
            self::ROLE_SUPER_ADMIN => 'Super admin',
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_USER => 'Utilisateur'
        );
    }
}
