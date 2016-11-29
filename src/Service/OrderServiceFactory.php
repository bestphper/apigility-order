<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/29
 * Time: 19:13
 */
namespace ApigilityOrder\Service;

use Zend\ServiceManager\ServiceManager;

class OrderServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new OrderService($services);
    }
}