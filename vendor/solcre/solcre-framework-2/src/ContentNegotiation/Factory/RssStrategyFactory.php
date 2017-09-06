<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Solcre\SolcreFramework2\ContentNegotiation\Factory;

use Solcre\SolcreFramework2\ContentNegotiation\RssStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RssStrategyFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return RssStrategy;
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $renderer = $serviceLocator->get('Solcre\SolcreFramework2\ContentNegotiation\RssRenderer');
        return new RssStrategy($renderer);
    }
}
