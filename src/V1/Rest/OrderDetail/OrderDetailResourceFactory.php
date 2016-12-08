<?php
namespace ApigilityOrder\V1\Rest\OrderDetail;

class OrderDetailResourceFactory
{
    public function __invoke($services)
    {
        return new OrderDetailResource($services);
    }
}
