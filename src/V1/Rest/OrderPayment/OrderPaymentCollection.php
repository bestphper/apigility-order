<?php
namespace ApigilityOrder\V1\Rest\OrderPayment;

use ApigilityCatworkFoundation\Base\ApigilityCollection;

class OrderPaymentCollection extends ApigilityCollection
{
    protected $itemType = OrderPaymentEntity::class;
}
