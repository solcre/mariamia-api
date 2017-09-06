<?php

namespace Mariamia\V1\Rest\Products;

class ProductsResourceFactory
{
    public function __invoke($services)
    {
        $productService = $services->get('Solcre\Mariamia\Service\ProductService');
        return new ProductsResource($productService);
    }
}
