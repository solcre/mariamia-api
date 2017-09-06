<?php

namespace Mariamia\V1\Rest\Sections;

use ZF\ApiProblem\ApiProblem;
use Solcre\SolcreFramework2\Common\BaseResource;
use Solcre\SolcreFramework2\Adapter\PaginatedAdapter;

class SectionsResource extends BaseResource
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
        $shops = $this->service->fetchAllPaginated($params, []);
        $adapter = new PaginatedAdapter($shops);
        return new SectionsCollection($adapter);
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
