<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityOrder\V1\Rest\Order\OrderResource::class => \ApigilityOrder\V1\Rest\Order\OrderResourceFactory::class,
            \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResource::class => \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResourceFactory::class,
            \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentResource::class => \ApigilityOrder\V1\Rest\OrderPayment\OrderPaymentResourceFactory::class,
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
                    'route' => '/order-payment[/:order_payment_id]',
                    'defaults' => [
                        'controller' => 'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller',
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
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityOrder\\V1\\Rest\\Order\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\OrderPayment\\Controller' => 'HalJson',
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
