<?php

namespace Nazka\PayableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nazka\PayableBundle\Entity\Payable
 * @ORM\Table()
 * @ORM\Entity
 */
class Payable
{

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var payments
     *
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="payable", cascade={"persist","remove"})
     */
    protected $payments;

    /**
     * @var float $payable_import
     *
     * @ORM\Column(name="payable_import", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $payable_import = 0.00;

    /**
     * Get is_paid
     *
     * @return boolean
     */
    public function isPaid()
    {
        return !($this->getRemainingImport() > 0);
    }

    public function getRemainingImport()
    {
        return $this->getPayableImport() - $this->getPaidImport();
    }

    public function getPaidImport()
    {
        $paid = 0.00;
        foreach ($this->getPayments() as $payment) {
            $paid += $payment->getImport();
        }

        return $paid;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->payments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add payments
     *
     * @param Nazka\PayableBundle\Entity\Payment $payments
     * @return Budget
     */
    public function addPayment(\Nazka\PayableBundle\Entity\Payment $payments)
    {
        $this->payments[] = $payments;
        $payments->setPayable($this);

        return $this;
    }

    /**
     * Remove payments
     *
     * @param Nazka\PayableBundle\Entity\BudgetPayment $payments
     */
    public function removePayment(\Nazka\PayableBundle\Entity\Payment $payments)
    {
        $this->payments->removeElement($payments);
    }

    /**
     * Get payments
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

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
     * Set payable_import
     *
     * @param float $payableImport
     * @return Payable
     */
    public function setPayableImport($payableImport)
    {
        $this->payable_import = $payableImport;

        return $this;
    }

    /**
     * Get payable_import
     *
     * @return float 
     */
    public function getPayableImport()
    {
        return $this->payable_import;
    }

    public function __toString()
    {
        return '';
    }
}
