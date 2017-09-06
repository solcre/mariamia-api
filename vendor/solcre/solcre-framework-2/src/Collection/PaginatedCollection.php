<?php

namespace Solcre\SolcreFramework2\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class PaginatedCollection extends ArrayCollection
{

    protected $page;
    protected $pageSize;
    protected $pageCount;
    protected $totalItems;

    public function getPage()
    {
        return $this->page;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;

        //Run calculate
        $this->calculatePageCount();
    }

    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;
    }

    public function getTotalItems()
    {
        return $this->totalItems;
    }

    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;

        //Run calculate
        $this->calculatePageCount();
    }

    public function __construct(array $elements = array(), $totalItems = 1, $pageSize = 25, $page = 1)
    {
        parent::__construct($elements);
        //Init values
        $this->page = !empty($page) ? $page : 0;
        $this->pageSize = !empty($pageSize) ? $pageSize : 25;
        $this->totalItems = !empty($totalItems) ? $totalItems : 0;

        //Run calculate
        $this->calculatePageCount();
    }

    protected function calculatePageCount()
    {
        $totalItems = $this->getTotalItems();
        $pageSize = $this->getPageSize();

        if ($totalItems <= 0 || $pageSize <= 0) {
            return;
        }

        if ($pageSize >= $totalItems) {
            $this->pageCount = 1;
        } else {
            $this->pageCount = ceil($totalItems / $pageSize);
        }
    }
}

?>