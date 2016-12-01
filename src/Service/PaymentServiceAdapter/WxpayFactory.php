<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/1
 * Time: 11:23
 */
namespace ApigilityOrder\Service\PaymentServiceAdapter;

use Zend\ServiceManager\ServiceManager;

class WxpayFactory
{
    public function __invoke(ServiceManager $services)
    {
        $wxpay = new Wxpay();
        $config = $services->get('config');
        $wxpay->setConfig($config['apigility-order']['payment-adapter']['wxpay']);
        return $wxpay;
    }
}