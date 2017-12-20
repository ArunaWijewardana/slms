<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentCategory
 *
 * @ORM\Table(name="payment_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentCategoryRepository")
 */
class PaymentCategory
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment", mappedBy="paymentCategory")
     */
    private $payment;

    public function __construct()
    {
        $this->status = 'Active';
        $this->createdAt = new \DateTime('NOW');
        $this->modifiedAt = new \DateTime('NOW');

        $this->payment = new ArrayCollection();
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
     * @return PaymentCategory
     */
    public function setTitle($title):PaymentCategory
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
    public function getPayment():mixed
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     * @return mixed
     */
    public function setPayment($payment): mixed
    {
        $this->payment = $payment;
    }
}

