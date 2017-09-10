<?php

namespace Mariamia\V1\Rpc\Info;

class InfoControllerFactory
{
    public function __invoke($controllers)
    {
        $services = $controllers->getServiceLocator();
        $shopService = $services->get('Solcre\Mariamia\Service\ShopService');
        return new InfoController($shopService);
    }
}
