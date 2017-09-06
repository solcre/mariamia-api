<?php

namespace Solcre\SolcreFramework2\Service\Factory;

use Solcre\SolcreFramework2\Service\EmailService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EmailServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mailer = new \PHPMailer;
        $configuration = $serviceLocator->get('config');
        return new EmailService($mailer, $configuration);
    }

}
