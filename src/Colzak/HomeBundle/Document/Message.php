<?php
// src/Colzak/HomeBundle/Document/Message.php

namespace Colzak\HomeBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document()
 * @MongoDB\HasLifecycleCallbacks
 */
class Message
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $subject;

    /**
     * @MongoDB\String
     */
    protected $body;

    /**
     * @MongoDB\String
     */
    protected $from;

    /**
     * @MongoDB\Date
     */
    protected $createdAt;

    /**
     * @MongoDB\Boolean
     */
    protected $isRead;

    public function __construct() {
        $this->isRead = false;
    }

    /**
     * @MongoDB\PrePersist()
     */
    public function doStuffOnPrePersist() {
        $this->createdAt = new \MongoDate();
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
     * Set subject
     *
     * @param string $subject
     * @return self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get body
     *
     * @return string $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set from
     *
     * @param string $from
     * @return self
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get from
     *
     * @return string $from
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     * @return self
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean $isRead
     */
    public function getIsRead()
    {
        return $this->isRead;
    }
}
