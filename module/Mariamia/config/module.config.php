<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Mariamia\\V1\\Rest\\Shops\\ShopsResource' => 'Mariamia\\V1\\Rest\\Shops\\ShopsResourceFactory',
            'Mariamia\\V1\\Rest\\Products\\ProductsResource' => 'Mariamia\\V1\\Rest\\Products\\ProductsResourceFactory',
            'Mariamia\\V1\\Rest\\Sections\\SectionsResource' => 'Mariamia\\V1\\Rest\\Sections\\SectionsResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'mariamia.rest.shops' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/shops[/:shops_id]',
                    'defaults' => array(
                        'controller' => 'Mariamia\\V1\\Rest\\Shops\\Controller',
                    ),
                ),
            ),
            'mariamia.rest.products' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/products[/:products_id]',
                    'defaults' => array(
                        'controller' => 'Mariamia\\V1\\Rest\\Products\\Controller',
                    ),
                ),
            ),
            'mariamia.rest.sections' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/sections[/:sections_id]',
                    'defaults' => array(
                        'controller' => 'Mariamia\\V1\\Rest\\Sections\\Controller',
                    ),
                ),
            ),
            'mariamia.rpc.info' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/info',
                    'defaults' => array(
                        'controller' => 'Mariamia\\V1\\Rpc\\Info\\Controller',
                        'action' => 'info',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'mariamia.rest.shops',
            1 => 'mariamia.rest.products',
            2 => 'mariamia.rest.sections',
            3 => 'mariamia.rpc.info',
        ),
    ),
    'zf-rest' => array(
        'Mariamia\\V1\\Rest\\Shops\\Controller' => array(
            'listener' => 'Mariamia\\V1\\Rest\\Shops\\ShopsResource',
            'route_name' => 'mariamia.rest.shops',
            'route_identifier_name' => 'shops_id',
            'collection_name' => 'shops',
            'entity_http_methods' => array(
                0 => 'PATCH',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Solcre\\Mariamia\\Entity\\ShopEntity',
            'collection_class' => 'Mariamia\\V1\\Rest\\Shops\\ShopsCollection',
            'service_name' => 'Shops',
        ),
        'Mariamia\\V1\\Rest\\Products\\Controller' => array(
            'listener' => 'Mariamia\\V1\\Rest\\Products\\ProductsResource',
            'route_name' => 'mariamia.rest.products',
            'route_identifier_name' => 'products_id',
            'collection_name' => 'products',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => 'size',
            'entity_class' => 'Solcre\\Mariamia\\Entity\\ProductEntity',
            'collection_class' => 'Mariamia\\V1\\Rest\\Products\\ProductsCollection',
            'service_name' => 'Products',
        ),
        'Mariamia\\V1\\Rest\\Sections\\Controller' => array(
            'listener' => 'Mariamia\\V1\\Rest\\Sections\\SectionsResource',
            'route_name' => 'mariamia.rest.sections',
            'route_identifier_name' => 'sections_id',
            'collection_name' => 'sections',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Solcre\\Mariamia\\Entity\\SectionEntity',
            'collection_class' => 'Mariamia\\V1\\Rest\\Sections\\SectionsCollection',
            'service_name' => 'Sections',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Mariamia\\V1\\Rest\\Shops\\Controller' => 'HalJson',
            'Mariamia\\V1\\Rest\\Products\\Controller' => 'HalJson',
            'Mariamia\\V1\\Rest\\Sections\\Controller' => 'HalJson',
            'Mariamia\\V1\\Rpc\\Info\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Mariamia\\V1\\Rest\\Shops\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Mariamia\\V1\\Rest\\Products\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Mariamia\\V1\\Rest\\Sections\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Mariamia\\V1\\Rpc\\Info\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Mariamia\\V1\\Rest\\Shops\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/json',
            ),
            'Mariamia\\V1\\Rest\\Products\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/json',
            ),
            'Mariamia\\V1\\Rest\\Sections\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/json',
            ),
            'Mariamia\\V1\\Rpc\\Info\\Controller' => array(
                0 => 'application/vnd.mariamia.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Solcre\\Mariamia\\Entity\\ShopEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.shops',
                'route_identifier_name' => 'shops_id',
                'hydrator' => 'Solcre\\SolcreFramework2\\Hydrator\\EntityHydrator',
            ),
            'Mariamia\\V1\\Rest\\Shops\\ShopsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.shops',
                'route_identifier_name' => 'shops_id',
                'is_collection' => true,
            ),
            'Solcre\\Mariamia\\Entity\\ProductEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.products',
                'route_identifier_name' => 'products_id',
                'hydrator' => 'Solcre\\SolcreFramework2\\Hydrator\\EntityHydrator',
            ),
            'Mariamia\\V1\\Rest\\Products\\ProductsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.products',
                'route_identifier_name' => 'products_id',
                'is_collection' => true,
            ),
            'Solcre\\Mariamia\\Entity\\SectionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.sections',
                'route_identifier_name' => 'sections_id',
                'hydrator' => 'Solcre\\SolcreFramework2\\Hydrator\\EntityHydrator',
            ),
            'Mariamia\\V1\\Rest\\Sections\\SectionsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.sections',
                'route_identifier_name' => 'sections_id',
                'is_collection' => true,
            ),
            'Mariamia\\V1\\Rest\\Products\\ProductsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'mariamia.rest.products',
                'route_identifier_name' => 'products_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Mariamia\\V1\\Rest\\Shops\\Controller' => array(
            'input_filter' => 'Mariamia\\V1\\Rest\\Shops\\Validator',
        ),
        'Mariamia\\V1\\Rest\\Products\\Controller' => array(
            'input_filter' => 'Mariamia\\V1\\Rest\\Products\\Validator',
        ),
        'Mariamia\\V1\\Rest\\Sections\\Controller' => array(
            'input_filter' => 'Mariamia\\V1\\Rest\\Sections\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Mariamia\\V1\\Rest\\Shops\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'address',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'latitude',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'longitude',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            4 => array(
                'name' => 'stock',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'email',
            ),
            6 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'password',
            ),
        ),
        'Mariamia\\V1\\Rest\\Products\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'type',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'thc',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'cbd',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'description',
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'image',
                'type' => 'Zend\\InputFilter\\FileInput',
            ),
        ),
        'Mariamia\\V1\\Rest\\Sections\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'title',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'content',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'usefulYes',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'usefulNo',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Mariamia\\V1\\Rest\\Shops\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => true,
                    'DELETE' => false,
                ),
            ),
            'Mariamia\\V1\\Rpc\\Info\\Controller' => array(
                'actions' => array(
                    'Info' => array(
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Mariamia\\V1\\Rpc\\Info\\Controller' => 'Mariamia\\V1\\Rpc\\Info\\InfoControllerFactory',
        ),
    ),
    'zf-rpc' => array(
        'Mariamia\\V1\\Rpc\\Info\\Controller' => array(
            'service_name' => 'Info',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'mariamia.rpc.info',
        ),
    ),
);
