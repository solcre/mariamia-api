<?php

namespace Solcre\SolcreFramework2\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\Forward;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\ParametersInterface;
use ZF\ContentNegotiation\Request;
use Solcre\SolcreFramework2\Entity\RouteInfo;
use ZF\ContentNegotiation\ParameterDataContainer;

class RouteForwardPlugin extends Forward
{

    protected function simulateEvent($routeInfo)
    {
        $route = $routeInfo;

        if ($routeInfo instanceof RouteInfo) {
            $method = $routeInfo->getMethod();
            $route = $routeInfo->getRoute();
            $queryParams = $routeInfo->getQueryParams();
            $bodyParams = $routeInfo->getBodyParams();
        }

        $event = clone $this->getEvent();
        $this->event = $event;

        $request = new Request();
        $request->getUri()->setPath($route);

        if ($queryParams instanceof ParametersInterface) {
            $request->setQuery($queryParams);
        }
        if (!empty($method)) {
            $request->setMethod($method);
        }
        if ($bodyParams instanceof ParametersInterface) {
            $request->setPost($bodyParams);
        } else {
            if ($bodyParams instanceof ParameterDataContainer) {
                $this->event->setParam('ZFContentNegotiationParameterData', $bodyParams);
            }
        }
        $this->event->setRequest($request);

        $router = clone $event->getRouter();
        $this->event->setRouter($router);
        return $this->event;
    }

    protected function matches()
    {
        $routeMatch = $this->event->getRouter()->match($this->event->getRequest());
        if (!($routeMatch instanceof RouteMatch)) {
            return false;
        }

        $this->event->setRouteMatch($routeMatch);

        $this->getController()->getEventManager()->trigger(MvcEvent::EVENT_ROUTE, $this->event);

        return true;
    }

    public function dispatch($routes)
    {
        if (!is_array($routes)) {
            $routes = array($routes);
        }
        return $this->dispatchMultiple($routes);
    }

    protected function dispatchOne()
    {
        $controllerName = $this->event->getRouteMatch()->getParam('controller');
        $params = $this->event->getRouteMatch()->getParams();

        return parent::dispatch($controllerName, $params);
    }

    public function dispatchMultiple(Array $routes)
    {
        $data = array();

        foreach ($routes as $routeInfo) {
            if ($routeInfo instanceof RouteInfo) {
                $event = $this->simulateEvent($routeInfo);

                if (!$this->matches()) {

                }

                $dispatchResponse = $this->dispatchOne();
                $routeName = $event->getRouteMatch()->getMatchedRouteName();

                //Load response
                $routeInfo->setRouteName($routeName);
                $routeInfo->setResponse($dispatchResponse);

                //Push
                $data[] = $routeInfo;
            }
        }

        return $data;
    }

    public function getControllerName($route)
    {
        $event = $this->simulateEvent($route);
        $this->matches();
        return $event->getRouteMatch()->getParam('controller');
    }
}
