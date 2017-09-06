<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Solcre\\Mariamia\\Service\\ShopService'    => 'Solcre\\Mariamia\\Service\\Factory\\ShopServiceFactory',
            'Solcre\\Mariamia\\Service\\ProductService' => 'Solcre\\Mariamia\\Service\\Factory\\ProductServiceFactory',
            'Solcre\\Mariamia\\Service\\SectionService' => 'Solcre\\Mariamia\\Service\\Factory\\SectionServiceFactory'
        )
    ),
    'doctrine'        => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'vendor/solcre/mariamia/src/Entity'
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default'          => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Solcre\\Mariamia\\Entity' => 'my_annotation_driver',
                ],
            ],
        ],
    ]
);
