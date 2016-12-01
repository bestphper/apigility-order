<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 21:25
 */
namespace ApigilityOrder\Service\PaymentServiceAdapter;

use ApigilityOrder\DoctrineEntity\Order;

class Wxpay implements PaymentServiceAdapterInterface
{
    const PAYMENT_TYPE = 'wxpay';
    protected $config;

    public function getPaymentType()
    {
        return self::PAYMENT_TYPE;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function makePaymentData(Order $order)
    {
        return $this->makeSignData($order->getSeriesNumber(), $order->getTitle(), $order->getTotal(), $order->getTitle());
    }

    public function handleNotification(callable $callback)
    {
        $this->handleNotify($callback);
    }

    //判断是否是https
    private function http_url(){
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http_type.$_SERVER['HTTP_HOST'];
    }

    private function makeSignData($order_number, $order_name, $total, $order_description)
    {
        $WxPayConfig_Data = $this->config;
        require_once dirname(__FILE__).'/../../../vendor/Wxpay/bootstrap.php';

        $wechatAPI = new \WxPayApi();

        $input = new \WxPayUnifiedOrder();
        $input->SetBody(mb_substr($order_name,0,50,'utf-8'));
        $input->SetOut_trade_no($order_number);
        $input->SetTotal_fee($total*100);
        $input->SetNotify_url($this->http_url().'/order/payment/notify/wxpay');
        $input->SetTrade_type('APP');
        $response = $wechatAPI->unifiedOrder($input, $timeOut = 15);

        $inputObj = new \WxPayAppPay();
        $inputObj->SetAppId(\WxPayConfig::APPID);
        $inputObj->SetPartnerId(\WxPayConfig::MCHID);
        $inputObj->SetPrepayId($response['prepay_id']);
        $inputObj->SetPackageValue('Sign=WXPay');
        $inputObj->SetNonceStr(\WxPayApi::getNonceStr());
        $inputObj->SetTimeStamp(time());
        $inputObj->SetSign();


        $values = $inputObj->getValues();

        //初始化日志
        $logHandler= new \CLogFileHandler($WxPayConfig_Data['log_path']."/".date('Y-m-d').'.txt');
        $log = \Log::Init($logHandler, 15);

        return $values;
    }

    private function handleNotify(callable $callback)
    {
        $WxPayConfig_Data = $this->config;
        require_once dirname(__FILE__).'/../../../vendor/Wxpay/bootstrap.php';

        //初始化日志
        $logHandler= new \CLogFileHandler($WxPayConfig_Data['log_path']."/".date('Y-m-d').'.txt');
        $log = \Log::Init($logHandler, 15);

        try {
            \Log::DEBUG("begin notify");
            \Log::DEBUG($GLOBALS['HTTP_RAW_POST_DATA']);
            $notify = new \PayNotifyCallBack();
            $notify->setCallback($callback);
            $rs = $notify->Handle(false);

            \Log::DEBUG("end notify");
        } catch (\Exception $e) {
            \Log::DEBUG($e->getMessage());
            \Log::DEBUG("end notify");
        }
    }
}