<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Solcre\SolcreFramework2\ContentNegotiation\Factory;

use Solcre\SolcreFramework2\ContentNegotiation\RssRenderer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RssRendererFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return RssRenderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $apiProblemRenderer = $serviceLocator->get('ZF\ApiProblem\ApiProblemRenderer');
        $helpers = $serviceLocator->get('ViewHelperManager');
        $renderer = new RssRenderer($apiProblemRenderer);
        $renderer->setHelperPluginManager($helpers);
        $renderer->setServiceLocator($serviceLocator);
        return $renderer;

    }
}
