<?php

return array(
    'service_manager'        => array(
        'factories' => array(
            'Solcre\\SolcreFramework2\\Service\\EmailService'                     => 'Solcre\\SolcreFramework2\\Service\\Factory\\EmailServiceFactory',
            'Solcre\\SolcreFramework2\\Filter\\FieldsFilterService'               => 'Solcre\\SolcreFramework2\\Filter\\Factory\\FieldsFilterServiceFactory',
            'Solcre\\SolcreFramework2\\Filter\\ExpandFilterService'               => 'Solcre\\SolcreFramework2\\Filter\\Factory\\ExpandFilterServiceFactory',
            'Solcre\\SolcreFramework2\\Event\\AcceptLanguageListener'             => 'Solcre\\SolcreFramework2\\Event\\Factory\\AcceptLanguageListenerFactory',
            'Solcre\\SolcreFramework2\\Event\\RenderEntityListener'               => 'Solcre\\SolcreFramework2\\Event\\Factory\\RenderEntityListenerFactory',
            'Solcre\\SolcreFramework2\\Event\\PostRenderEntityListener'           => 'Solcre\\SolcreFramework2\\Event\\Factory\\PostRenderEntityListenerFactory',
            'Solcre\\SolcreFramework2\\Event\\EventRouteListener'                 => 'Solcre\\SolcreFramework2\\Event\\Factory\\EventRouteListenerFactory',
            'Solcre\\SolcreFramework2\\Oauth\\Adapter\\ApiAdapter'                => 'Solcre\\SolcreFramework2\\Oauth\\Adapter\\Factory\\ApiAdapterFactory',
            'Solcre\\SolcreFramework2\\ContentNegotiation\\Parsers\NewsRssParser' => 'Solcre\\SolcreFramework2\\ContentNegotiation\\Parsers\\Factory\\NewsRssParserFactory',
        ),
    ),
    'controller_plugins'     => array(
        'factories' => array(
            'RouteForwardPlugin' => 'Solcre\SolcreFramework2\Controller\Plugin\Factory\RouteForwardPluginFactory',
        ),
    ),
    'zf-hal'                 => array(
        'metadata_map' => array(
            'Doctrine\ORM\PersistentCollection'           => array(
                'hydrator'     => 'Zend\Stdlib\Hydrator\ArraySerializable',
                'isCollection' => true,
            ),
            'Doctrine\Common\Collections\ArrayCollection' => array(
                'isCollection' => true,
            ),
        ),
    ),
    'doctrine'               => array(
        'configuration' => array(
            'orm_default' => array(
                'filters' => array(
                    'search' => 'Solcre\SolcreFramework2\Common\SearchFilter',
                ),
            )
        ),
    ),
    'zf-rest'                => array(
        'controllers' => array(
            'collection_query_whitelist' => array(
                'query',
                'fields',
            )
        )
    ),
    'hydrators'              => array(
        'factories' => array(
            'Solcre\\SolcreFramework2\\Hydrator\\EntityHydrator'            => 'Solcre\\SolcreFramework2\\Hydrator\\Factory\\EntityHydratorFactory',
            'Solcre\\SolcreFramework2\\Hydrator\\EntityTranslationHydrator' => 'Solcre\\SolcreFramework2\\Hydrator\\Factory\\EntityTranslationHydratorFactory',
        )
    ),
    'zf-content-negotiation' => array(
        'selectors' => array(
            'Csv-HalJson' => array(
                'ZF\Hal\View\HalJsonModel'                               => array(
                    'application/json',
                    'application/*+json',
                ),
                'Solcre\\SolcreFramework2\\ContentNegotiation\\CsvModel' => array(
                    'text/csv',
                    'application/csv',
                    'application/vnd.columnis.v2+csv',
                    'application/vnd.ecommerce.v2+csv',
                ),
                'Solcre\\SolcreFramework2\\ContentNegotiation\\RssModel' => array(
                    'application/rss+xml',
                ),
            ),
            'Pdf-HalJson' => array(
                'ZF\Hal\View\HalJsonModel'                               => array(
                    'application/json',
                    'application/vnd.columnis.v2+json',
                    'application/vnd.ecommerce.v2+json',
                ),
                'Solcre\\SolcreFramework2\\ContentNegotiation\\PdfModel' => array(
                    'text/pdf',
                    'application/pdf',
                    'application/vnd.columnis.v2+pdf',
                    'application/vnd.ecommerce.v2+pdf',
                ),
            )
        ),
    ),
    'columnis'               => array(
        'PdfStrategy'                    => array(
            'default' => 'Solcre\\SolcreFramework2\\Strategy\\Pdf\\DefaultStrategy',
        ),
        'zf-content-negotiation-parsers' => [
            'NewsEntity' => 'Solcre\\SolcreFramework2\\ContentNegotiation\\Parsers\NewsRssParser'
        ],
    ),
    'array_modules'          => array(
        ""               => 0,
        "secciones"      => 1,
        "contacto"       => 2,
        "maillist"       => 3,
        "registro"       => 4,
        "login"          => 5,
        "perfil"         => 6,
        "catalogo"       => 7,
        "destacados"     => 8,
        "reviews"        => 9,
        "carrito"        => 10,
        "perfil_publico" => 11,
        "banners"        => 12,
        "noticias"       => 13,
        "fotos_home"     => 14,
        "galerias"       => 15,
        "jukebox"        => 16,
        "portfolio"      => 17,
        "videos"         => 18,
        "ubicacion"      => 19,
        "encuestas"      => 20,
        "archivos"       => 21,
        "propiedades"    => 22,
        "cotizacion"     => 23,
        "comentarios"    => 24,
        "curriculums"    => 25,
        "buscador"       => 26,
        "area_privada"   => 27,
        "clima"          => 28,
        "juegos"         => 29,
        "gestion"        => 30,
        "siniestros"     => 31,
        "ofertasbasicas" => 32,
        "nodes"          => 33,
    )
);
