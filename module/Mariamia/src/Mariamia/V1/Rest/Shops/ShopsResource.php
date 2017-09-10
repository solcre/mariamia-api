<?php

namespace Mariamia\V1\Rest\Shops;

use ZF\ApiProblem\ApiProblem;
use Solcre\SolcreFramework2\Adapter\PaginatedAdapter;
use Solcre\SolcreFramework2\Common\BaseResource;

class ShopsResource extends BaseResource
{

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     *
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $shops = $this->service->fetchAllPaginated($params, []);
        $adapter = new PaginatedAdapter($shops);
        return new ShopsCollection($adapter);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return $this->service->patch($id, $data);
    }
}
