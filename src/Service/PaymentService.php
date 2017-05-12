<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 19:32
 */
namespace ApigilityOrder\Service;

use ApigilityCatworkFoundation\Base\ApigilityEventAwareObject;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityOrder\DoctrineEntity;
use ApigilityUser\DoctrineEntity\User;
use Zend\Math\Rand;

class PaymentService extends ApigilityEventAwareObject
{
    const EVENT_PAY_SUCCESS = 'PaymentService.EVENT_PAY_SUCCESS';

    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var PaymentServiceAdapter\PaymentServiceAdapterInterface
     */
    protected $paymentAdapter;

    /**
     * @var \ApigilityOrder\Service\OrderService
     */
    protected $orderService;

    public function __construct(ServiceManager $services, PaymentServiceAdapter\PaymentServiceAdapterInterface $adapter = null)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->orderService = $services->get('ApigilityOrder\Service\OrderService');

        $this->paymentAdapter = $adapter;
    }

    public function setAdapter(PaymentServiceAdapter\PaymentServiceAdapterInterface $adapter)
    {
        $this->paymentAdapter = $adapter;
    }

    public function makeClientPaymentData($order_id)
    {
        $order = $this->orderService->getOrder($order_id);
        return $this->paymentAdapter->makePaymentData($order);
    }

    public function handlePaymentServerNotification()
    {
        $orderService = $this->orderService;
        $em = $this->em;
        $this->paymentAdapter->handleNotification(function ($order_sn, $payment_type, $payment_sn) use ($orderService, $em){
            // 如果支付成功，这里将处理订单状态
            $order = $orderService->getOrderBySN($order_sn);

            if ((int)$order->getStatus() == $order::STATUS_WAIT_TO_PAY) {
                $order->setStatus($order::STATUS_PAYED);
                $order->setPaymentSeriesNumber($payment_sn);
                $order->setPaymentType($payment_type);
                $order->setPayTime(new \DateTime());
                $em->flush();

                $this->getEventManager()->trigger(self::EVENT_PAY_SUCCESS, $this, ['order' => $order]);
            }
        });
    }
}