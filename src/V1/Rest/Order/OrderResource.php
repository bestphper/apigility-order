<?php
namespace ApigilityOrder\V1\Rest\Order;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class OrderResource extends ApigilityResource
{
    /**
     * @var \ApigilityOrder\Service\OrderService
     */
    protected $orderService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->orderService = $services->get('ApigilityOrder\Service\OrderService');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            return new OrderEntity($this->orderService->getOrder($id), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        try {
            return new OrderCollection($this->orderService->getOrders($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

}
