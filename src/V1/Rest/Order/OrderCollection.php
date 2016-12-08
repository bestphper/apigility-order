<?php
namespace ApigilityOrder\V1\Rest\Order;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class OrderCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = OrderEntity::class;
}
