<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 19:33
 */
namespace ApigilityOrder\Service;

use Zend\ServiceManager\ServiceManager;

class PaymentServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new PaymentService($services);
    }
}