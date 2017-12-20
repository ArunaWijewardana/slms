<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * BookCategory
 *
 * @ORM\Table(name="book_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookCategoryRepository")
 */
class BookCategory
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Book", mappedBy="bookCategory")
     */
    private $book;

    public function __construct()
    {
        $this->status = 'Active';
        $this->createdAt = new \DateTime('NOW');
        $this->modifiedAt = new \DateTime('NOW');

        $this->book = new ArrayCollection();
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
     * @return BookCategory
     */
    public function setTitle($title):BookCategory
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
     * @return mixed
     */
    public function getBook():mixed
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     * @return mixed
     */
    public function setBook($book): mixed
    {
        $this->book = $book;
    }
}

