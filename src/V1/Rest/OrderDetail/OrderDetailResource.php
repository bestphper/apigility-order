<?php
namespace ApigilityOrder\V1\Rest\OrderDetail;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class OrderDetailResource extends ApigilityResource
{
    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
    }
}
