<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lending
 *
 * @ORM\Table(name="lending")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LendingRepository")
 */
class Lending
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="lending")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book", inversedBy="lending")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lendingDate", type="datetime", nullable=true)
     */
    private $lendingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dueDate", type="datetime", nullable=true)
     */
    private $dueDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="returnDate", type="datetime", nullable=true)
     */
    private $returnDate;

    public function __construct()
    {
        $this->createdAt = new \DateTime('NOW');
        $this->modifiedAt = new \DateTime('NOW');
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
     * @return Lending
     */
    public function setTitle($title):Lending
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
     * Set user
     *
     * @param integer $user
     *
     * @return Lending
     */
    public function setUser($user):Lending
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser(): ? User
    {
        return $this->user;
    }

    /**
     * Set book
     *
     * @param integer $book
     *
     * @return Lending
     */
    public function setBook($book):Lending
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return Book
     */
    public function getBook(): ? Book
    {
        return $this->book;
    }

    /**
     * Set lendingDate
     *
     * @param \DateTime $lendingDate
     *
     * @return Lending
     */
    public function setLendingDate($lendingDate):Lending
    {
        $this->lendingDate = $lendingDate;

        return $this;
    }

    /**
     * Get lendingDate
     *
     * @return \DateTime
     */
    public function getLendingDate(): ? \DateTime
    {
        return $this->lendingDate;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Lending
     */
    public function setDueDate($dueDate):Lending
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate(): ? \DateTime
    {
        return $this->dueDate;
    }

    /**
     * Set returnDate
     *
     * @param \DateTime $returnDate
     *
     * @return Lending
     */
    public function setReturnDate($returnDate):Lending
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get returnDate
     *
     * @return \DateTime
     */
    public function getReturnDate(): ? \DateTime
    {
        return $this->returnDate;
    }
}

