<?php

// src/Colzak/BlogBundle/Document/Article.php

namespace Colzak\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @MongoDB\Document
 * @MongoDB\HasLifecycleCallbacks
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
     * @Assert\File(maxSize="6000000")
     */
    protected $file;

    /**
     * @MongoDB\String
     */
    protected $filePath;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Category")
     */
    protected $category;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Colzak\UserBundle\Document\User")
     */
    protected $createdBy;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Colzak\UserBundle\Document\User")
     */
    protected $lastModifiedBy;

    /**
     * @MongoDB\Timestamp
     */
    protected $createdAt;

    /**
     * @MongoDB\Timestamp
     */
    protected $updatedAt;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Status")
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
     * Set filePath
     *
     * @param string $filePath
     * @return self
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * Get filePath
     *
     * @return string $filePath
     */
    public function getFilePath()
    {
        return $this->filePath;
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
     * Set createdBy
     *
     * @param Colzak\UserBundle\Document\User $createdBy
     * @return self
     */
    public function setCreatedBy(\Colzak\UserBundle\Document\User $createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return Colzak\UserBundle\Document\User $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set lastModifiedBy
     *
     * @param Colzak\UserBundle\Document\User $lastModifiedBy
     * @return self
     */
    public function setLastModifiedBy(\Colzak\UserBundle\Document\User $lastModifiedBy)
    {
        $this->lastModifiedBy = $lastModifiedBy;
        return $this;
    }

    /**
     * Get lastModifiedBy
     *
     * @return Colzak\UserBundle\Document\User $lastModifiedBy
     */
    public function getLastModifiedBy()
    {
        return $this->lastModifiedBy;
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

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

        public function getAbsolutePath()
    {
        return null === $this->filePath
            ? null
            : $this->getUploadRootDir().'/'.$this->filePath;
    }

    public function getWebPath()
    {
        return null === $this->filePath
            ? null
            : $this->getUploadDir().'/'.$this->filePath;
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
        return '/uploads/articles/'.$this->getId().'/';
    }

    /**
     * @MongoDB\PostPersist()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        $fileExtension = $this->getFile()->guessExtension();

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getId().'.'.$this->getFile()->guessExtension()
        );
        

        // set the path property to the filename where you've saved the file
        $this->filePath = $this->getUploadDir().$this->getId().'.'.$fileExtension;

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
