<?php

namespace Nazka\PayableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Nazka\PayableBundle\Entity
 * @ORM\Entity
 * @ORM\Table()
 */
class Payment
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float $import
     * @Assert\Length(min = "0.01", minMessage = "Not a valid amount")
     * @ORM\Column(name="import", type="decimal", precision=10, scale=2)
     */
    private $import;

    /**
     * @ORM\Column(name="payment_method", type="integer", nullable=true)
     * @var type
     */
    protected $paymentMethod;

    /**
     * @var integer $payable
     *
     * @ORM\ManyToOne(targetEntity="Payable", inversedBy="payments", cascade={"persist"})
     * @ORM\JoinColumn(name="payable", referencedColumnName="id", nullable=false)
     */
    private $payable;

    /**
     * @var \DateTime $payedAt
     *
     * @ORM\Column(name="payed_at", type="datetime")
     */
    private $payedAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set import
     *
     * @param float $import
     * @return Payment
     */
    public function setImport($import)
    {
        $this->import = $import;

        return $this;
    }

    /**
     * Get import
     *
     * @return float 
     */
    public function getImport()
    {
        return $this->import;
    }

    /**
     * Set paymentMethod
     *
     * @param integer $paymentMethod
     * @return PaymentMode
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return integer 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set payed_at
     *
     * @param \DateTime $payedAt
     * @return Payment
     */
    public function setPayedAt($payedAt)
    {
        $this->payedAt = $payedAt;

        return $this;
    }

    /**
     * Get payed_at
     *
     * @return \DateTime 
     */
    public function getPayedAt()
    {
        return $this->payedAt;
    }

    /**
     * Validates import is equal or under the remaining import
     *
     * @Assert\True(message = "Import is higher than remaining import")
     */
    public function isImportValid()
    {
        $import = $this->getImport();
        $remaining = $this->getPayable()->getRemainingImport();
        $epsilon = 0.00001;

        // comparing float equality must be this way
        // http://www.php.net/manual/en/language.types.float.php
        return ($import < $remaining || (abs($import - $remaining) < $epsilon) );
    }

    /**
     * Set payable
     *
     * @param Nazka\PayableBundle\Entity\Payable $payable
     * @return Payment
     */
    public function setPayable(\Nazka\PayableBundle\Entity\Payable $payable)
    {
        $this->payable = $payable;

        return $this;
    }

    /**
     * Get payable
     *
     * @return Nazka\PayableBundle\Entity\Payable 
     */
    public function getPayable()
    {
        return $this->payable;
    }
}