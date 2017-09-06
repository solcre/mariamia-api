<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Solcre\SolcreFramework2\ContentNegotiation\Factory;

use Solcre\SolcreFramework2\ContentNegotiation\PdfRenderer;
use Solcre\SolcreFramework2\Utility\Pdf;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PdfRendererFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return PdfRenderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $apiProblemRenderer = $serviceLocator->get('ZF\ApiProblem\ApiProblemRenderer');
        $tcpdf = new \TCPDF();
        $smarty = new \Smarty();
        $helpers = $serviceLocator->get('ViewHelperManager');
        $pdfUtility = new Pdf();
        $config = $serviceLocator->get('config');
        $columnisConfigurationService = $serviceLocator->get('Solcre\Columnis\Service\ConfigurationService');
        $renderer = new PdfRenderer($apiProblemRenderer, $tcpdf, $smarty, $pdfUtility, $serviceLocator, $config,
            $columnisConfigurationService);
        $renderer->setHelperPluginManager($helpers);
        return $renderer;

    }
}
