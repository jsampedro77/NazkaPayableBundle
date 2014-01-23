<?php

namespace Nazka\PayableBundle\Manager;

use Nazka\PayableBundle\Model\PayableItemInterface;
use Nazka\PayableBundle\Entity\Payment;

/**
 * Description of PaymentManager
 *
 * @author javier
 */
class PayableManager
{

    public function createPayment(PayableItemInterface $payableItem, $import, $paymentMethod)
    {
        $payment = new Payment();
        $payment->setImport($import);
        $payment->setPaymentMethod($paymentMethod);
        $payment->setPayedAt(new \DateTime());
        $payableItem->getPayable()->addPayment($payment);

        return $payment;
    }
}
