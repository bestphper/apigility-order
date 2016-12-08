<?php
namespace ApigilityOrder\V1\Rest\OrderPayment;


class OrderPaymentEntity
{
    const PAYMENT_TYPE_ALIPAY = 1;
    const PAYMENT_TYPE_WXPAY = 2;

    protected $order_id;
    protected $payment_type;
    protected $payment_data;

    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;
        return $this;
    }

    public function getPaymentType()
    {
        return $this->payment_type;
    }

    public function setPaymentData($payment_data)
    {
        $this->payment_data = $payment_data;
        return $this;
    }

    public function getPaymentData()
    {
        return $this->payment_data;
    }
}
