<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 21:40
 */
ini_set('date.timezone','Asia/Shanghai');
require_once dirname(__FILE__).'/WxPay.Api.php';
require_once dirname(__FILE__).'/WxPay.Notify.php';
require_once dirname(__FILE__).'/log.php';

class WxPayAppPay extends \WxPayDataBase
{
    public function SetAppId($value)
    {
        $this->values['appid'] = $value;
    }

    public function SetPartnerId($value)
    {
        $this->values['partnerid'] = $value;
    }

    public function SetPrepayId($value)
    {
        $this->values['prepayid'] = $value;
    }

    public function SetPackageValue($value)
    {
        $this->values['package'] = $value;
    }

    public function SetNonceStr($value)
    {
        $this->values['noncestr'] = $value;
    }

    public function SetTimeStamp($value)
    {
        $this->values['timestamp'] = $value;
    }

    public function getValues()
    {
        return $this->values;
    }
}

class PayNotifyCallBack extends \WxPayNotify
{
    protected $callback;
    protected $paymentType;

    public function setPaymentType($payment_type)
    {
        $this->paymentType = $payment_type;
    }

    public function setCallback(callable $callback)
    {
        $this->callback = $callback;
    }

    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($input);
        \Log::DEBUG("query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        \Log::DEBUG("call back:" . json_encode($data));
        $notfiyOutput = array();

        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }

        $callback = $this->callback;
        $callback($data["out_trade_no"], $this->paymentType, $data["transaction_id"]);

        return true;
    }
}