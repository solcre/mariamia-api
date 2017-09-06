<?php

namespace Solcre\SolcreFramework2\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\Plugin\Service\ForwardFactory;
use Solcre\SolcreFramework2\Controller\Plugin\RouteForwardPlugin;

class RouteForwardPluginFactory extends ForwardFactory
{
    /**
     * {@inheritDoc}
     *
     * @return Forward
     * @throws ServiceNotCreatedException if Controllermanager service is not found in application service locator
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        if (!$container->has('ControllerManager')) {
            throw new ServiceNotCreatedException(sprintf(
                '%s requires that the application service manager contains a "%s" service; none found',
                __CLASS__,
                'ControllerManager'
            ));
        }
        $controllers = $container->get('ControllerManager');

        return new RouteForwardPlugin($controllers);
    }

}
