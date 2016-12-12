<?php
namespace ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay;

class PaymentNotificationFromAlipayResourceFactory
{
    public function __invoke($services)
    {
        return new PaymentNotificationFromAlipayResource($services);
    }
}
