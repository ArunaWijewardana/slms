<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="payment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaymentCategory", inversedBy="payment")
     * @ORM\JoinColumn(name="paymentCategory_id", referencedColumnName="id")
     */
    private $paymentCategory;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", nullable=true)
     *
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paymentDate", type="datetimetz", nullable=true)
     */
    private $paymentDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dueDate", type="datetime", nullable=true)
     */
    private $dueDate;

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
     * @return Payment
     */
    public function setTitle($title):Payment
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
     * @return Payment
     */
    public function setUser($user):Payment
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
     * Set paymentCategory
     *
     * @param integer $paymentCategory
     *
     * @return Payment
     */
    public function setPaymentCategory($paymentCategory):Payment
    {
        $this->paymentCategory = $paymentCategory;

        return $this;
    }

    /**
     * Get paymentCategory
     *
     * @return PaymentCategory
     */
    public function getPaymentCategory(): ? PaymentCategory
    {
        return $this->paymentCategory;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payment
     */
    public function setAmount($amount):Payment
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount(): ? float
    {
        return $this->amount;
    }

    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     *
     * @return Payment
     */
    public function setPaymentDate($paymentDate):Payment
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Get paymentDate
     *
     * @return \DateTime
     */
    public function getPaymentDate(): ? \DateTime
    {
        return $this->paymentDate;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Payment
     */
    public function setDueDate($dueDate):Payment
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
}

