<?php

namespace Mariamia\V1\Rest\Shops;

class ShopsResourceFactory
{
    public function __invoke($services)
    {

        $shopService = $services->get('Solcre\Mariamia\Service\ShopService');
        return new ShopsResource($shopService);
    }
}