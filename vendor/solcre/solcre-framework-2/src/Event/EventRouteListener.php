<?php

namespace Solcre\SolcreFramework2\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\MvcEvent;
use ZF\ContentNegotiation\Request;
use ZF\Hal\Plugin\Hal;
use Solcre\SolcreFramework2\Extractor\CustomEntityExtractor;
use Solcre\SolcreFramework2\Extractor\CustomLinkCollectionExtractor;

class EventRouteListener implements ListenerAggregateInterface
{

    protected $listeners = [];
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'onEventRoute'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onEventRoute(MvcEvent $e)
    {
        $renderEntityListener = $this->serviceLocator->get('Solcre\SolcreFramework2\Event\RenderEntityListener');
        $hal = $this->serviceLocator->get('ControllerPluginManager')->get('Hal');
        $view = $this->serviceLocator->get('View');

        //Init Hal entity extractor (For cache management)
        $this->setHalExtractor($hal);
        $this->setHalLinkCollectionExtractor($hal);

        //Get event managers
        $halEventManager = $hal->getEventManager();
        $renderEntityEventManager = $renderEntityListener->getEventManager();
        $viewEventManager = $view->getEventManager();

        //Attach renderEntity listener
        $halEventManager->attach($renderEntityListener);
        $viewEventManager->attach($renderEntityListener);

        //Attach acceptLanguage to renderEntityListener
        $renderEntityEventManager->attach($this->serviceLocator->get('Solcre\SolcreFramework2\Event\AcceptLanguageListener'));
        //Attach post render entity
        $halEventManager->attach($this->serviceLocator->get('Solcre\SolcreFramework2\Event\PostRenderEntityListener'));
    }

    private function setHalExtractor(Hal &$hal)
    {
        //Create and replace entity extractor
        $entityHydratorManager = $hal->getEntityHydratorManager();
        $customEntityExtractor = new CustomEntityExtractor($entityHydratorManager);
        $hal->setEntityExtractor($customEntityExtractor);
    }

    private function setHalLinkCollectionExtractor(Hal &$hal)
    {
        $request = $this->serviceLocator->get("Request");
        /* @var $request Request */
        $linkExtractor = $this->serviceLocator->get('ZF\Hal\Extractor\LinkExtractor');
        $customLinkCollectionExtractor = new CustomLinkCollectionExtractor($linkExtractor);
        $customLinkCollectionExtractor->setClientCode($request->getQuery('client'));
        $hal->setLinkCollectionExtractor($customLinkCollectionExtractor);
    }
}

?>