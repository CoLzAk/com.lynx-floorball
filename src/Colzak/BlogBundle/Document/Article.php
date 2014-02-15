<?php

// src/Colzak/BlogBundle/Document/Article.php

namespace Colzak\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Article {

	/**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $title;

    /**
     * @MongoDB\String
     */
    protected $content;

    /**
     * @MongoDB\EmbedOne(targetDocument="Category")
     */
    protected $category;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Colzak\UserBundle\Document\User")
     */
    protected $publisher;

    /**
     * @MongoDB\Timestamp
     */
    protected $createdAt;

    /**
     * @MongoDB\Timestamp
     */
    protected $updatedAt;

    /**
     * @MongoDB\EmbedOne(targetDocument="Status")
     */
    protected $status;


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
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set category
     *
     * @param Colzak\BlogBundle\Document\Category $category
     * @return self
     */
    public function setCategory(\Colzak\BlogBundle\Document\Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Colzak\BlogBundle\Document\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set publisher
     *
     * @param Colzak\UserBundle\Document\User $publisher
     * @return self
     */
    public function setPublisher(\Colzak\UserBundle\Document\User $publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * Get publisher
     *
     * @return Colzak\UserBundle\Document\User $publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set createdAt
     *
     * @param timestamp $createdAt
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
     * @return timestamp $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param timestamp $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return timestamp $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set status
     *
     * @param Colzak\BlogBundle\Document\Status $status
     * @return self
     */
    public function setStatus(\Colzak\BlogBundle\Document\Status $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return Colzak\BlogBundle\Document\Status $status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
