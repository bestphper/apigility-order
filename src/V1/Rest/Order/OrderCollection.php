<?php
namespace ApigilityOrder\V1\Rest\Order;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class OrderCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new OrderEntity($item));
        }
        return $collection;
    }
}
