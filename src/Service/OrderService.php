<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/29
 * Time: 19:12
 */
namespace ApigilityOrder\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityOrder\DoctrineEntity;
use ApigilityUser\DoctrineEntity\User;
use Zend\Math\Rand;

class OrderService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 创建一个订单
     *
     * @param $title
     * @param User $user
     * @return DoctrineEntity\Order
     */
    public function createOrder($title, User $user)
    {
        $order = new DoctrineEntity\Order();
        $order->setTitle($title)->setUser($user);
        $order->setSeriesNumber($this->generateOrderSeriesNumber());
        $order->setTotal(0.00);
        $order->setCreateTime(new \DateTime());
        $order->setStatus($order::STATUS_WAIT_TO_PAY);
        $order->setRefundStatus($order::REFUND_STATUS_NONE);
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }

    /**
     * 创建一项订单明细
     *
     * @param DoctrineEntity\Order $order
     * @param $title
     * @param $price
     * @param int $quantity
     * @param null $product_id
     * @param null $specification_id
     * @return DoctrineEntity\OrderDetail
     */
    public function createOrderDetail(DoctrineEntity\Order $order, $title, $price, $quantity = 1, $product_id = null, $specification_id = null)
    {
        $orderDetail = new DoctrineEntity\OrderDetail();
        $orderDetail->setOrder($order);
        $orderDetail->setTitle($title)
            ->setPrice($price)
            ->setQuantity($quantity)
            ->setProductId($product_id)
            ->setSpecificationId($specification_id);
        $this->em->persist($orderDetail);

        $order->setTotal($price*$quantity);

        $this->em->flush();

        return $orderDetail;
    }

    /**
     * 生成唯一的订单序列号
     * @return string
     */
    private function generateOrderSeriesNumber()
    {
        $series_number = null;

        do {
            $time = new \DateTime();
            $series_number = $time->format('YmdHisu') . '-' .Rand::getString(5, '123456789');

            $orders = $this->em->getRepository('ApigilityOrder\DoctrineEntity\Order')->findBy([
                'series_number'=>$series_number
            ]);
        } while (count($orders));

        return $series_number;
    }

    /**
     * 获取一个订单
     * @param $order_id
     * @return \ApigilityOrder\DoctrineEntity\Order
     * @throws \Exception
     */
    public function getOrder($order_id)
    {
        $order = $this->em->find('ApigilityOrder\DoctrineEntity\Order', $order_id);
        if (empty($order)) throw new \Exception(404, '订单不存在');

        return $order;
    }

    /**
     * 获取订单列表
     * @return DoctrinePaginatorAdapter
     */
    public function getOrders($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('o')->from('ApigilityOrder\DoctrineEntity\Order', 'o');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}