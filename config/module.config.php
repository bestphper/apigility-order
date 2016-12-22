<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityOrder\V1\Rest\Order\OrderResource::class => \ApigilityOrder\V1\Rest\Order\OrderResourceFactory::class,
            \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResource::class => \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResourceFactory::class,
            \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentResource::class => \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentResourceFactory::class,
            \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayResource::class => \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayResourceFactory::class,
            \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayResource::class => \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-order.rest.order' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/order[/:order_id]',
                    'defaults' => [
                        'controller' => 'ApigilityOrder\\V1\\Rest\\Order\\Controller',
                    ],
                ],
            ],
            'apigility-order.rest.order-detail' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/order-detail[/:order_detail_id]',
                    'defaults' => [
                        'controller' => 'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller',
                    ],
                ],
            ],
            'apigility-order.rest.order-payment' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/order/order-payment[/:order_payment_id]',
                    'defaults' => [
                        'controller' => 'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller',
                    ],
                ],
            ],
            'apigility-order.rest.payment-notification-from-alipay' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/order/payment-notification-from-alipay[/:payment_notification_from_alipay_id]',
                    'defaults' => [
                        'controller' => 'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromAlipay\\Controller',
                    ],
                ],
            ],
            'apigility-order.rest.payment-notification-from-wxpay' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/order/payment-notification-from-wxpay[/:payment_notification_from_wxpay_id]',
                    'defaults' => [
                        'controller' => 'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromWxpay\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-order.rest.order',
            1 => 'apigility-order.rest.order-detail',
            2 => 'apigility-order.rest.order-payment',
            3 => 'apigility-order.rest.payment-notification-from-alipay',
            4 => 'apigility-order.rest.payment-notification-from-wxpay',
        ],
    ],
    'zf-rest' => [
        'ApigilityOrder\\V1\\Rest\\Order\\Controller' => [
            'listener' => \ApigilityOrder\V1\Rest\Order\OrderResource::class,
            'route_name' => 'apigility-order.rest.order',
            'route_identifier_name' => 'order_id',
            'collection_name' => 'order',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityOrder\V1\Rest\Order\OrderEntity::class,
            'collection_class' => \ApigilityOrder\V1\Rest\Order\OrderCollection::class,
            'service_name' => 'Order',
        ],
        'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller' => [
            'listener' => \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResource::class,
            'route_name' => 'apigility-order.rest.order-detail',
            'route_identifier_name' => 'order_detail_id',
            'collection_name' => 'order_detail',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailEntity::class,
            'collection_class' => \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailCollection::class,
            'service_name' => 'OrderDetail',
        ],
        'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller' => [
            'listener' => \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentResource::class,
            'route_name' => 'apigility-order.rest.order-payment',
            'route_identifier_name' => 'order_payment_id',
            'collection_name' => 'order_payment',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentEntity::class,
            'collection_class' => \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentCollection::class,
            'service_name' => 'OrderPayment',
        ],
        'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromAlipay\\Controller' => [
            'listener' => \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayResource::class,
            'route_name' => 'apigility-order.rest.payment-notification-from-alipay',
            'route_identifier_name' => 'payment_notification_from_alipay_id',
            'collection_name' => 'payment_notification_from_alipay',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayEntity::class,
            'collection_class' => \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayCollection::class,
            'service_name' => 'PaymentNotificationFromAlipay',
        ],
        'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromWxpay\\Controller' => [
            'listener' => \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayResource::class,
            'route_name' => 'apigility-order.rest.payment-notification-from-wxpay',
            'route_identifier_name' => 'payment_notification_from_wxpay_id',
            'collection_name' => 'payment_notification_from_wxpay',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayEntity::class,
            'collection_class' => \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayCollection::class,
            'service_name' => 'PaymentNotificationFromWxpay',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityOrder\\V1\\Rest\\Order\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromAlipay\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromWxpay\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityOrder\\V1\\Rest\\Order\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromAlipay\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
                3 => 'application/x-www-form-urlencoded',
            ],
            'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromWxpay\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
                3 => 'application/x-www-form-urlencoded',
                4 => 'text/html',
            ],
        ],
        'content_type_whitelist' => [
            'ApigilityOrder\\V1\\Rest\\Order\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/json',
            ],
            'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/json',
            ],
            'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/json',
            ],
            'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromAlipay\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ],
            'ApigilityOrder\\V1\\Rest\\PaymentNotificationFromWxpay\\Controller' => [
                0 => 'application/vnd.apigility-order.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ApigilityOrder\V1\Rest\Order\OrderEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.order',
                'route_identifier_name' => 'order_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityOrder\V1\Rest\Order\OrderCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.order',
                'route_identifier_name' => 'order_id',
                'is_collection' => true,
            ],
            \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.order-detail',
                'route_identifier_name' => 'order_detail_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.order-detail',
                'route_identifier_name' => 'order_detail_id',
                'is_collection' => true,
            ],
            \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentEntity::class => [
                'entity_identifier_name' => 'order_id',
                'route_name' => 'apigility-order.rest.order-payment',
                'route_identifier_name' => 'order_payment_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentCollection::class => [
                'entity_identifier_name' => 'order_id',
                'route_name' => 'apigility-order.rest.order-payment',
                'route_identifier_name' => 'order_payment_id',
                'is_collection' => true,
            ],
            \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.payment-notification-from-alipay',
                'route_identifier_name' => 'payment_notification_from_alipay_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityOrder\V1\Rest\PaymentNotificationFromAlipay\PaymentNotificationFromAlipayCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.payment-notification-from-alipay',
                'route_identifier_name' => 'payment_notification_from_alipay_id',
                'is_collection' => true,
            ],
            \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.payment-notification-from-wxpay',
                'route_identifier_name' => 'payment_notification_from_wxpay_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityOrder\V1\Rest\PaymentNotificationFromWxpay\PaymentNotificationFromWxpayCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-order.rest.payment-notification-from-wxpay',
                'route_identifier_name' => 'payment_notification_from_wxpay_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller' => [
            'input_filter' => 'ApigilityOrder\\V1\\Rest\\OrderPayment\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ApigilityOrder\\V1\\Rest\\OrderPayment\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'order_id',
                'description' => '要支付的订单',
                'error_message' => '请指定要支付的订单',
                'field_type' => 'int',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'payment_type',
                'description' => '支付方式',
                'field_type' => 'int',
                'error_message' => '请指定支付方式',
            ],
        ],
    ],
];
