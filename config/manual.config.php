<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 21:02
 */
return [
    'apigility-order'=>[
        'payment-adapter'=>[
            'alipay'=>[
                'partner'=>'',
                'seller_id'=>'',
                'private_key_path'=>'',
                'ali_public_key_path'=>'',
                'ssl_cacert_path'=>'',
                'log_path'=>'',
                'notify_url'=>''
            ],
            'wxpay'=>[
                'APPID'=>'',
                'MCHID'=>'',
                'KEY'=>'',
                'APPSECRET'=>'',
                'SSLCERT_PATH'=>'',
                'SSLKEY_PATH'=>'',
                'log_path'=>'',
                'notify_url'=>''
            ]
        ],
    ],
];