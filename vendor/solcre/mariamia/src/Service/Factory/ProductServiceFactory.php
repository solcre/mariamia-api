<?php

namespace Solcre\Mariamia\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Solcre\Mariamia\Service\ProductService;

class ProductServiceFactory implements FactoryInterface
{

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get(\Doctrine\ORM\EntityManager::class);
        $config = $serviceLocator->get("config");
        return new ProductService($entityManager, $config);
    }

}
