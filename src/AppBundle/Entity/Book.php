<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 */
class Book
{
    use FieldTraits;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="publishingYear", type="date", nullable=true)
     */
    private $publishingYear;

    /**
     * @var string
     *
     * @ORM\Column(name="publishingPlace", type="string", length=255, nullable=true)
     */
    private $publishingPlace;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BookCategory", inversedBy="book")
     * @ORM\JoinColumn(name="bookCategory_id", referencedColumnName="id")
     */
    private $bookCategory;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lending", mappedBy="book")
     */
    private $lending;

    public function __construct()
    {
        $this->createdAt = new \DateTime('NOW');
        $this->modifiedAt = new \DateTime('NOW');

        $this->lending = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getBookAndAuthor():string
    {
        return $this->getTitle().' by '.$this->getAuthor();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title):Book
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): ? string
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author):Book
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor(): ? string
    {
        return $this->author;
    }

    /**
     * Set publishingYear
     *
     * @param \Datetime $publishingYear
     *
     * @return Book
     */
    public function setPublishingYear($publishingYear):Book
    {
        $this->publishingYear = $publishingYear;

        return $this;
    }

    /**
     * Get publishingYear
     *
     * @return \DateTime
     */
    public function getPublishingYear(): ? \DateTime
    {
        return $this->publishingYear;
    }

    /**
     * Set publishingPlace
     *
     * @param string $publishingPlace
     *
     * @return Book
     */
    public function setPublishingPlace($publishingPlace):Book
    {
        $this->publishingPlace = $publishingPlace;

        return $this;
    }

    /**
     * Get publishingPlace
     *
     * @return string
     */
    public function getPublishingPlace(): ? string
    {
        return $this->publishingPlace;
    }

    /**
     * Set bookCategory
     *
     * @param integer $bookCategory
     *
     * @return Book
     */
    public function setBookCategory($bookCategory):Book
    {
        $this->bookCategory = $bookCategory;

        return $this;
    }

    /**
     * Get bookCategory
     *
     * @return BookCategory
     */
    public function getBookCategory(): ? BookCategory
    {
        return $this->bookCategory;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Book
     */
    public function setQuantity($quantity):Book
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity(): ? int
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getLending():mixed
    {
        return $this->lending;
    }

    /**
     * @param mixed $lending
     * @return mixed
     */
    public function setLending($lending): mixed
    {
        $this->lending = $lending;
    }
}

