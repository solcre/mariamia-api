<?php

namespace Solcre\Mariamia\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Solcre\Mariamia\Service\ShopService;

class ShopServiceFactory implements FactoryInterface
{

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {

        $entityManager = $serviceLocator->get(\Doctrine\ORM\EntityManager::class);

        return new ShopService($entityManager);
    }

}
