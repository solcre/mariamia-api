<?php

namespace Solcre\SolcreFramework2\Event\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Solcre\SolcreFramework2\Event\PostRenderEntityListener;

class PostRenderEntityListenerFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controllerPluginManager = $serviceLocator->get('ControllerPluginManager');
        $halPlugin = $controllerPluginManager->get('Hal');

        return new PostRenderEntityListener($halPlugin);
    }
}

?>