<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Solcre\SolcreFramework2\ContentNegotiation\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Solcre\SolcreFramework2\ContentNegotiation\CsvRenderer;

class CsvRendererFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return CsvRenderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $apiProblemRenderer = $serviceLocator->get('ZF\ApiProblem\ApiProblemRenderer');
        $renderer = new CsvRenderer($apiProblemRenderer);

        return $renderer;
    }
}
