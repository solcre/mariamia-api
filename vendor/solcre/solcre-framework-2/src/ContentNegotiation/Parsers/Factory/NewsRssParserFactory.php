<?php

namespace Solcre\SolcreFramework2\ContentNegotiation\Parsers\Factory;

use Solcre\SolcreFramework2\ContentNegotiation\Parsers\NewsRssParser;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewsRssParserFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $columnisConfigurationService = $serviceLocator->get('Solcre\Columnis\Service\ConfigurationService');
        $config = $serviceLocator->get('config');
        return new NewsRssParser($config, $columnisConfigurationService);
    }


}


