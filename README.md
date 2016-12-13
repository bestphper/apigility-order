# Apigility-order #
订单组件

# 依赖 #
ApigilityUser

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
