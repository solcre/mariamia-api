<?php

namespace Solcre\SolcreFramework2\Filter\Factory;

use Solcre\SolcreFramework2\Filter\FieldsFilterService;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class FieldsFilterServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $helpers = $serviceLocator->get('ViewHelperManager');
        $halPlugin = $helpers->get('Hal');

        return new FieldsFilterService($halPlugin);
    }
}
