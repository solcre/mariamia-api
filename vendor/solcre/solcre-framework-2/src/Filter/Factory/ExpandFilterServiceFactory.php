<?php

namespace Solcre\SolcreFramework2\Filter\Factory;

use Solcre\SolcreFramework2\Filter\ExpandFilterService;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ExpandFilterServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $helpers = $serviceLocator->get('ViewHelperManager');
        $halPlugin = $helpers->get('Hal');

        return new ExpandFilterService($halPlugin);
    }
}
