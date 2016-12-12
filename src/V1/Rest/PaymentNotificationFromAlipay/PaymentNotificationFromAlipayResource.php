<?php
namespace ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class PaymentNotificationFromAlipayResource extends ApigilityResource
{
    /**
     * @var \ApigilityOrder\Service\PaymentService
     */
    protected $paymentService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->paymentService = $this->serviceManager->get('ApigilityOrder\Service\PaymentService');
        $this->paymentService->setAdapter($this->serviceManager->get('ApigilityOrder\Service\PaymentServiceAdapter\Alipay'));
    }

    public function create($data)
    {
        $this->paymentService->handlePaymentServerNotification();
        exit();
    }
}
