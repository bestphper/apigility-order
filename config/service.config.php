<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 14:52
 */
return [
    'service_manager' => array(
        'factories' => array(
            'ApigilityOrder\Service\OrderService'=>'ApigilityOrder\Service\OrderServiceFactory',
            'ApigilityOrder\Service\PaymentService'=>'ApigilityOrder\Service\PaymentServiceFactory',
            'ApigilityOrder\Service\PaymentServiceAdapter\Alipay'=>'ApigilityOrder\Service\PaymentServiceAdapter\AlipayFactory',
            'ApigilityOrder\Service\PaymentServiceAdapter\Wxpay'=>'ApigilityOrder\Service\PaymentServiceAdapter\WxpayFactory'
        ),
    )
];