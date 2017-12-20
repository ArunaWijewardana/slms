<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserCategory
 *
 * @ORM\Table(name="user_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserCategoryRepository")
 */
class UserCategory
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="userCategory")
     */
    private $user;

    public function __construct()
    {
        $this->status = 'Active';
        $this->createdAt = new \DateTime('NOW');
        $this->modifiedAt = new \DateTime('NOW');

        $this->user = new ArrayCollection();
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
     * @return UserCategory
     */
    public function setTitle($title):UserCategory
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle():? string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUser():string
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return user
     */
    public function setUser($user):user
    {
        $this->user = $user;
    }
}

