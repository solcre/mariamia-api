<?php

namespace Solcre\SolcreFramework2\Adapter;

use Zend\Paginator\Adapter\AdapterInterface;
use Solcre\SolcreFramework2\Entity\PaginatedResult;

class PaginatedAdapter implements AdapterInterface
{

    /**
     *
     * @var PaginatedResult
     */
    protected $paginatedResult;

    public function __construct(PaginatedResult $paginatedResult)
    {
        $this->paginatedResult = $paginatedResult;
    }

    public function count($mode = 'COUNT_NORMAL')
    {
        return $this->paginatedResult->getTotalCount();
    }

    public function getItems($offset, $itemCountPerPage)
    {
        return $this->paginatedResult;
    }
}
