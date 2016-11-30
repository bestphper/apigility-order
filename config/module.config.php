<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityOrder\V1\Rest\Order\OrderResource::class => \ApigilityOrder\V1\Rest\Order\OrderResourceFactory::class,
            \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResource::class => \ApigilityOrder\V1\Rest\OrderDetail\OrderDetailResourceFactory::class,
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
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-order.rest.order',
            1 => 'apigility-order.rest.order-detail',
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
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityOrder\\V1\\Rest\\Order\\Controller' => 'HalJson',
            'ApigilityOrder\\V1\\Rest\\OrderDetail\\Controller' => 'HalJson',
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
        ],
    ],
];
