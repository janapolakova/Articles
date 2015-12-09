<?php

namespace JPCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @author Jana Poláková <jana.polakova@icloud.com>
 * @ORM\Table(name="ARTICLE")
 * @ORM\Entity(repositoryClass="JPCoreBundle\Repository\ArticleRepository")
 */
class Article {
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="TITLE", type="string", length=150)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENT", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_CREATED", type="date")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="AUTHOR", type="string", length=150)
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_LAST_UPDATE", type="date")
     */
    private $dateLastUpdate;

    /**
     * Constructor.
     */
    public function __construct(){
        $this->dateCreated = new \DateTime();
        $this->dateLastUpdate = new \DateTime();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title){
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content){
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * Get dateCreated.
     *
     * @return \DateTime
     */
    public function getDateCreated(){
        return $this->dateCreated;
    }

    /**
     * Set dateCreated.
     *
     * @param \DateTime $dateCreated
     * @return $this
     */
    public function setDateCreated($dateCreated){
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor(){
        return $this->author;
    }

    /**
     * Set author.
     *
     * @param string $author
     * @return $this
     */
    public function setAuthor($author){
        $this->author = $author;

        return $this;
    }

    /**
     * Get dateLastUpdate.
     *
     * @return \DateTime
     */
    public function getDateLastUpdate(){
        return $this->dateLastUpdate;
    }

    /**
     * Set dateLastUpdate.
     *
     * @param \DateTime $dateLastUpdate
     * @return $this
     */
    public function setDateLastUpdate($dateLastUpdate){
        $this->dateLastUpdate = $dateLastUpdate;

        return $this;
    }
}