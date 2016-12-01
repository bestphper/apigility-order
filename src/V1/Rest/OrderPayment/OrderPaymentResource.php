<?php
namespace ApigilityOrder\V1\Rest\OrderPayment;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;

class OrderPaymentResource extends AbstractResourceListener
{
    /**
     * @var \ApigilityOrder\Service\PaymentService
     */
    protected $paymentService;

    /**
     * @var ServiceManager
     */
    protected $services;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
        $this->paymentService = $services->get('ApigilityOrder\Service\PaymentService');
    }

    /**
     * 发起一个订单支付
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            switch ((int)$data->payment_type) {
                case OrderPaymentEntity::PAYMENT_TYPE_ALIPAY:
                    $this->paymentService->setAdapter($this->services->get('ApigilityOrder\Service\PaymentServiceAdapter\Alipay'));
                    break;

                case OrderPaymentEntity::PAYMENT_TYPE_WXPAY:
                    $this->paymentService->setAdapter($this->services->get('ApigilityOrder\Service\PaymentServiceAdapter\Wxpay'));
                    break;

                default:
                    throw new \Exception('未知的支付方式：'.$data->payment_type, 404);
            }

            $order_payment =  new OrderPaymentEntity();
            $order_payment->setPaymentType($data->payment_type);
            $order_payment->setOrderId($data->order_id);
            $order_payment->setPaymentData($this->paymentService->makeClientPaymentData($data->order_id));

            return $order_payment;
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
