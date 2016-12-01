<?php
namespace ApigilityOrder\V1\Rest\OrderPayment;

class OrderPaymentResourceFactory
{
    public function __invoke($services)
    {
        return new OrderPaymentResource($services);
    }
}
