<?php

namespace Solcre\SolcreFramework2\Common;

use Zend\Mvc\MvcEvent;

class BaseModule
{

    public function onBootstrap(MvcEvent $e)
    {
        $this->checkOriginHeader($e);
        $em = $e->getApplication()->getEventManager();
        $em->attach(MvcEvent::EVENT_ROUTE, array($this, 'stripClientNumber'), 100);
    }

    public function stripClientNumber(MvcEvent $e)
    {
        $generateThumbsUri = '/api/generate_thumb';
        if ($_SERVER['REDIRECT_URL'] == $generateThumbsUri) {
            $uri = '/columnis/generate_thumb';
            $qsArr = array();
            parse_str($_SERVER["QUERY_STRING"], $qsArr);
            unset($qsArr["client"]);
            $queryParams = http_build_query($qsArr);
            $e->getRequest()->setRequestUri($uri . '?' . $queryParams);
            $e->getRequest()->getUri()->setPath($uri);
        } else {
            $moduleName = strtolower($this->getChildNamespace());
            $uri = $e->getRequest()->getRequestUri();
            if (!empty($uri)) {
                $uriParts = explode('/', $uri);
                if (is_array($uriParts) && count($uriParts) > 1) {
                    if ((int)$uriParts[1] > 0 && $uriParts[2] === $moduleName) {
                        $uri = substr($uri, strlen($uriParts[1]) + 1);
                        $e->getRequest()->setRequestUri($uri);
                        $uriParts = explode('?', $uri);
                        $e->getRequest()->getUri()->setPath($uriParts[0]);
                    } else {
                        if ($uriParts[2] === 'oauth') {
                            $uri = '/oauth';
                            $e->getRequest()->setRequestUri($uri);
                            $e->getRequest()->getUri()->setPath($uri);
                        }
                    }
                }
            }
        }
    }

    private function checkOriginHeader($e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $headers = $e->getRequest()->getHeaders();
        if ($headers->has('Origin')) {
            $headersArray = $headers->toArray();
            $origin = $headersArray['Origin'];
            if ($origin === 'file://') {
                unset($headersArray['Origin']);
                $headers->clearHeaders();
                $headers->addHeaders($headersArray);
                //this is a valid uri
                $headers->addHeaderLine('Origin', 'file://mobile');
            }
        }
    }

    private function getChildNamespace()
    {
        $currentClass = get_class($this);
        $refl = new \ReflectionClass($currentClass);
        $namespace = $refl->getNamespaceName();
        return $namespace;
    }
}

?>