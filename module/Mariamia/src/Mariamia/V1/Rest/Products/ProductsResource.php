<?php

namespace Mariamia\V1\Rest\Products;

use ZF\ApiProblem\ApiProblem;
use \Solcre\SolcreFramework2\Common\BaseResource;
use Solcre\SolcreFramework2\Adapter\PaginatedAdapter;

class ProductsResource extends BaseResource
{
    /**
     * Fetch a resource
     *
     * @param  mixed $id
     *
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->service->fetch($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     *
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $products = $this->service->fetchAllPaginated($params, $orderBy);
        $adapter = new PaginatedAdapter($products);
        return new ProductsCollection($adapter);
    }
}
