<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/1
 * Time: 11:23
 */
namespace ApigilityOrder\Service\PaymentServiceAdapter;

use Zend\ServiceManager\ServiceManager;

class AlipayFactory
{
    public function __invoke(ServiceManager $services)
    {
        $alipay = new Alipay();
        $config = $services->get('config');
        $alipay->setConfig($config['apigility-order']['payment-adapter']['alipay']);
        return $alipay;
    }
}