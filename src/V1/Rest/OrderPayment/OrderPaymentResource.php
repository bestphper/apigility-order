<?php
namespace ApigilityOrder\V1\Rest\OrderPayment;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class OrderPaymentResource extends ApigilityResource
{
    /**
     * @var \ApigilityOrder\Service\PaymentService
     */
    protected $paymentService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
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
                    $this->paymentService->setAdapter($this->serviceManager->get('ApigilityOrder\Service\PaymentServiceAdapter\Alipay'));
                    break;

                case OrderPaymentEntity::PAYMENT_TYPE_WXPAY:
                    $this->paymentService->setAdapter($this->serviceManager->get('ApigilityOrder\Service\PaymentServiceAdapter\Wxpay'));
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
}
