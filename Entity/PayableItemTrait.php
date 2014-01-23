<?php

namespace Nazka\PayableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Description of payableItemInterface
 *
 * @author Javier Sampedro <jsampedro77@gmail.com>
 */
trait PayableItemTrait 
{

    /**
     * @ORM\OneToOne(targetEntity="Nazka\PayableBundle\Entity\Payable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="payable_id", referencedColumnName="id", nullable=false)
     */
    private $payable;

    public function getPayable()
    {
        if (!$this->payable) {
            $this->setPayable(new Payable());
        }
        
        return $this->payable;
    }

    public function setPayable(Payable $payable)
    {
        $this->payable = $payable;
    }

    /**
     * Set import
     *
     * @param float $import
     * @return Budget
     */
    public function setImport($import)
    {
        $this->getPayable()->setPayableImport($import);

        return $this;
    }

    /**
     * Get import
     *
     * @return float
     */
    public function getImport()
    {
        return $this->getPayable()->getPayableImport();
    }

    public function getRemainingImport()
    {
        return $this->getPayable()->getRemainingImport();
    }

    /* alias to getImport */

    public function getPrice()
    {
        return $this->getImport();
    }
}
