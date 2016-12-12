<?php
namespace ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay;

class PaymentNotificationFromWxpayResourceFactory
{
    public function __invoke($services)
    {
        return new PaymentNotificationFromWxpayResource($services);
    }
}
