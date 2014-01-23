<?php

namespace Nazka\PayableBundle\Model;

use Nazka\PayableBundle\Entity\Payable;

/**
 * PayableItemInterface
 *
 * @author javier
 */
interface PayableItemInterface
{
    public function getPayable();

    public function setPayable(Payable $payable);

    public function setImport($import);

    public function getImport();
    
    public function getRemainingImport();

}