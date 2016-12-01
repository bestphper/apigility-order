<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 20:53
 */
namespace ApigilityOrder\Service\PaymentServiceAdapter;

use ApigilityOrder\DoctrineEntity\Order;

class Alipay implements PaymentServiceAdapterInterface
{
    const PAYMENT_TYPE = 'alipay';
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

    private function getConfig()
    {
        $alipay_config['partner'] = $this->config['partner'];

        $alipay_config['seller_id'] = $this->config['seller_id'];

        $alipay_config['private_key_path']	= $this->config['private_key_path'];

        $alipay_config['ali_public_key_path']= $this->config['ali_public_key_path'];


        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


        //签名方式 不需修改
        $alipay_config['sign_type']    = strtoupper('RSA');

        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset']= strtolower('utf-8');

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert']    = $this->config['ssl_cacert_path'];

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport']  = $this->config['transport'];

        return $alipay_config;
    }

    private function makeSignData($order_number, $order_name, $total, $order_description)
    {
        $alipay_config = self::getConfig();

        require_once dirname(__FILE__).'/../../../vendor/Alipay/alipay_submit.class.php';

        $parameter = array(
            "service" => "mobile.securitypay.pay",
            "partner" => trim($alipay_config['partner']),
            "seller_id" => trim($alipay_config['partner']),
            "payment_type" => '1',
            "notify_url" => $this->http_url() . '/order/payment/notify/alipay',
            "return_url" => $this->http_url() . '/order/payment/notify/alipay',
            "out_trade_no" => $order_number,
            "subject" => $order_name,
            "total_fee" => $total,
            "show_url" => '',
            "body" => $order_description,
            "it_b_pay" => '30m',
            "extern_token" => '',
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );


        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $alipay_str = $alipaySubmit->buildRequestParaToString($parameter);
        return $alipay_str;
    }

    //判断是否是https
    private function http_url(){
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http_type.$_SERVER['HTTP_HOST'];
    }

    private function handleNotify(callable $callback)
    {
        $alipay_config = $this->getConfig();

        require_once dirname(__FILE__).'/../../../vendor/Alipay/alipay_notify.class.php';

        logResult('收到通知，开始处理'.var_export($_POST,true), $alipay_config['log_path']);

        //计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号
            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //该种交易状态只在两种情况下出现
                //1、开通了普通即时到账，买家付款成功后。
                //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                $callback($out_trade_no, self::PAYMENT_TYPE, $trade_no);

            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

                $callback($out_trade_no, self::PAYMENT_TYPE, $trade_no);
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            echo "success";		//请不要修改或删除

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            logResult("验证失败", $alipay_config['log_path']);
        }

        logResult("================end=============".PHP_EOL, $alipay_config['log_path']);
    }
}