# Apigility Order 订单组件
提供订单管理功能，包括订单的支付功能。

暂时只支持两种支付方式：原生支付宝APP、以及原生的微信APP支付功能。
“原生”一词的意思是，与Ping++这类集成支付方式相对的。

## 依赖 
- [Apigility User](https://github.com/catworking/apigility-user) 每一个订单，必定会关联一个订单所有者

## 数据实体
### Order 订单
此订单实体是通用型的订单，不管购买何种商品，都可以关联到此实体，从而得到订单的管理和支付功能。

### OrderDetail 订单详情
每一个Order实体都会关联一个或多个OrderDetail。

## 订单的支付
提供了一个名为OrderPayment的接口来发起一个订单支付，可以在参数中指定要使用的支付方式，
此接口会返回APP发起支付请求所需要的信息。

当支付完成时，支付服务端会异步回调本组件的PaymentNotificationFromXXX接口，
并传入支付结果。

如果支付成功，本组件会自动处理订单的状态。但是如果组件外部需要处理支付成功后业务逻辑，
需要监听本组件支付成功事件PaymentService::EVENT_PAY_SUCCESS，详情请参考
PaymentService类。

## 支付适配器的配置
如果要启用特定的支付方式，需要为该支付方式配置适配器。

配置方式在/config/manual.config.php中可以找到，你应该从Apigility的全局配置中覆盖此配置，严禁直播改本组件模块中的默认配置。

# 支付宝异步请求样本 #
需要在接口配置中增加application/x-www-form-urlencoded到Accept whitelist和Content-Type whitelist
```php
Host: familydev.eebow.com.cn
X-Real-IP: 110.75.225.89
X-Forwarded-For: 110.75.225.89
Connection: close
Content-Length: 788
Content-Type: application/x-www-form-urlencoded; charset=utf-8
User-Agent: Mozilla/4.0
array (
  'discount' => '0.00',
  'payment_type' => '1',
  'subject' => '专家会诊',
  'trade_no' => '2016121321001004150288974796',
  'buyer_email' => '13710600463',
  'gmt_create' => '2016-12-13 10:50:13',
  'notify_type' => 'trade_status_sync',
  'quantity' => '1',
  'out_trade_no' => '20161213103514000000-63498',
  'seller_id' => '2088221370406674',
  'notify_time' => '2016-12-13 10:50:14',
  'body' => '专家会诊',
  'trade_status' => 'TRADE_SUCCESS',
  'is_total_fee_adjust' => 'N',
  'total_fee' => '0.01',
  'gmt_payment' => '2016-12-13 10:50:14',
  'seller_email' => 'rosy@eebow.com.cn',
  'price' => '0.01',
  'buyer_id' => '2088702739675150',
  'notify_id' => '411f6552c656499cb8a3164d3d06b6ah5q',
  'use_coupon' => 'N',
  'sign_type' => 'RSA',
  'sign' => 'VSZjHDWLb4KcUwNukTUVT65OYf2b7xrp+mQPQiW2jpAuRtglPmVLKEVKatu3WbF3A3AWYAjNJND+W+O0KcguFguip1jW/kyDZ/yqdBep7WIpiZnJLV96mVWLTetJuQ441Ti3ZCpkv7TG2EkyRg76nXzIwaqy6yH9uQZiC0frE40=',
)
```
