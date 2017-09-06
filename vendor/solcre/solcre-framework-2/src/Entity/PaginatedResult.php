<?php

namespace Solcre\SolcreFramework2\Entity;

use \ArrayIterator;
use \IteratorAggregate;

class PaginatedResult implements IteratorAggregate
{

    protected $totalCount;
    protected $items;

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getIterator()
    {
        $items = $this->items;

        if (!$items instanceof Traversable) {
            $items = new ArrayIterator($items);
        }

        return $items;
    }

    public function __construct($items, $totalCount = -1)
    {
        $this->totalCount = $totalCount;
        $this->items = $items;
    }

}