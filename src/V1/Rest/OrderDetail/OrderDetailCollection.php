<?php
namespace ApigilityOrder\V1\Rest\OrderDetail;

use ApigilityCatworkFoundation\Base\ApigilityCollection;

class OrderDetailCollection extends ApigilityCollection
{
    protected $itemType = OrderDetailEntity::class;
}
