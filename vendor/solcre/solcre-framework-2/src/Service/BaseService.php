<?php

namespace Solcre\SolcreFramework2\Service;

use Solcre\SolcreFramework2\Filter\FilterInterface;
use Solcre\SolcreFramework2\Common\BaseRepository;
use Solcre\SolcreFramework2\Entity\PaginatedResult;
use Zend\Paginator\Paginator;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Exception;
use ReflectionClass;

abstract class BaseService
{

    protected $entityManager;
    protected $repository;
    protected $entityName;
    protected $configuration;
    protected $currentPage = 1;
    protected $itemsCountPerPage = 25;

    public function __construct(EntityManager $entityManager = null)
    {
        $this->configuration = array();
        $this->entityManager = $entityManager;

        $this->entityName = $this->getEntityName();
        $this->repository = $this->entityManager->getRepository($this->entityName);


    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getItemsCountPerPage()
    {
        return $this->itemsCountPerPage;
    }

    public function setCurrentPage($currentPage)
    {
        if (empty($currentPage)) {
            return;
        }

        $this->currentPage = $currentPage;
    }

    public function setItemsCountPerPage($itemsCountPerPage)
    {
        if (empty($itemsCountPerPage)) {
            return;
        }

        $this->itemsCountPerPage = $itemsCountPerPage;
    }

    public function addFilter(FilterInterface $filter)
    {
        if ($this->repository instanceof BaseRepository) {
            $this->repository->addFilter($filter);
        }
    }

    public function prepareEntity($data, $strategies = null)
    {
        $class = $this->getEntityName();
        $hydrator = new DoctrineObject($this->entityManager, new $class);
        if (!empty($strategies)) {
            foreach ($strategies as $strategy) {
                $hydrator->addStrategy($strategy['field'], $strategy['strategy']);
            }
        }
        return $hydrator->hydrate($data, new $class);
    }

    public function add($data, $strategies = null)
    {
        $entityObj = $this->prepareEntity($data, $strategies);
        $this->entityManager->persist($entityObj);
        $this->entityManager->flush();
        return $entityObj;
    }

    public function fetch($id)
    {
        $entity = $this->repository->find($id);
        if (!empty($entity)) {
            return $entity;
        } else {
            throw new Exception("Entity not found", 404);
        }
    }

    public function fetchOne($id, $params = [])
    {
        $params['id'] = $id;
        return $this->repository->findOneBy($params);
    }

    public function fetchBy($params = null, $orderBy = null)
    {
        return $this->repository->findOneBy($params, $orderBy);
    }

    public function fetchAll($params = null, $orderBy = null)
    {
        if (!empty($params) || !empty($orderBy)) {
            return $this->repository->findBy((array)$params, $orderBy);
        }
        return $this->repository->findAll();
    }

    public function fetchAllPaginated($params = null, $orderBy = null)
    {
        //Get paginator
        $doctrinePaginator = $this->repository->findByPaginated((array)$params, $orderBy);
        return $this->paginateResults($doctrinePaginator);
    }

    protected function paginateResults(DoctrinePaginator $doctrinePaginator)
    {
        //Get options
        $currentPage = (int)$this->getCurrentPage();
        $pageSize = (int)$this->getItemsCountPerPage();

        //Here is where configures the paginator options and iterate for doctrinePaginator
        //The doctrine paginator with getIterator, rise the queries taking page size
        //and current page params.
        $paginator = new Paginator($doctrinePaginator);
        $paginator->setItemCountPerPage($pageSize);
        $paginator->setCurrentPageNumber($currentPage);

        //Get array result
        $arrayResult = [];
        foreach ($paginator as $item) {
            $arrayResult[] = $item;
        }

        //Fill the iterator and return it
        return new PaginatedResult($arrayResult, $doctrinePaginator->count());
    }

    public function delete($id, $entityObj = null)
    {
        if (empty($entityObj)) {
            $entityObj = $this->fetch($id);
        }
        $this->entityManager->remove($entityObj);
        $this->entityManager->flush();
        return true;
    }

    public function update($id, $data)
    {
        throw new Exception("Method not implemented", 400);
    }

    public function getEntityName()
    {
        $namespaceName = (new ReflectionClass($this))->getNamespaceName();
        $className = (new ReflectionClass($this))->getShortName();
        $entityName = substr($className, 0, strpos($className, "Service"));
        $entityNamespace = str_replace('Service', 'Entity', $namespaceName);
        return $entityNamespace . '\\' . $entityName . "Entity";
    }

    public function getReference($id)
    {
        if (empty($id)) {
            return null;
        }
        return $this->entityManager->getReference($this->entityName, $id);
    }
}
