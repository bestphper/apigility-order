<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 19:54
 */
namespace ApigilityOrder\Service\PaymentServiceAdapter;

use ApigilityOrder\DoctrineEntity\Order;

interface PaymentServiceAdapterInterface
{
    /**
     * 返回支付适配器的唯一标识
     *
     * @return string
     */
    public function getPaymentType();

    /**
     * 设置适配器的支付配置信息
     *
     * @param array $config
     * @return mixed
     */
    public function setConfig($config);

    /**
     * 生成一个订单的App端支付数据
     *
     * @param Order $order
     * @return mixed
     */
    public function makePaymentData(Order $order);

    /**
     * 处理支付方的异步通知
     *
     * @param callable $callback
     * @return mixed
     */
    public function handleNotification(callable $callback);
}