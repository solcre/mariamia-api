<?php

namespace Solcre\SolcreFramework2\Hydrator\Factory;

use Solcre\SolcreFramework2\Hydrator\EntityHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityHydratorFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();
        return new EntityHydrator($parentLocator->get('doctrine.entitymanager.orm_default'));
    }
}
