<?php

namespace Solcre\SolcreFramework2\Entity;

class RouteInfo
{

    /**
     *
     * @var string
     */
    protected $route;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $routeName;

    /**
     *
     * @var string
     */
    protected $alias;

    /**
     *
     * @var array
     */
    protected $queryParams;

    /**
     *
     * @var array
     */
    protected $response;

    /**
     *
     * @var string
     */
    protected $componentId;

    /**
     *
     * @var array
     */
    protected $metadata;

    /**
     *
     * @var mixed
     */
    protected $component;

    /**
     *
     * @var string
     */
    protected $method;

    /**
     *
     * @var array
     */
    protected $bodyParams;

    /**
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     *
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     *
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     *
     * @param array $queryParams
     */
    public function setQueryParams($queryParams)
    {
        $this->queryParams = $queryParams;
    }

    /**
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     *
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     *
     * @param string $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     *
     * @param array $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     *
     * @return string
     */
    public function getComponentId()
    {
        return $this->componentId;
    }

    /**
     *
     * @param string $componentId
     */
    public function setComponentId($componentId)
    {
        $this->componentId = $componentId;
    }

    /**
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     *
     * @param array $metadata
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     *
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     *
     * @param mixed $component
     */
    public function setComponent($component)
    {
        $this->component = $component;
    }

    /**
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     *
     * @return array
     */
    public function getBodyParams()
    {
        return $this->bodyParams;
    }

    /**
     *
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     *
     * @param array $bodyParams
     */
    public function setBodyParams($bodyParams)
    {
        $this->bodyParams = $bodyParams;
    }
}

?>