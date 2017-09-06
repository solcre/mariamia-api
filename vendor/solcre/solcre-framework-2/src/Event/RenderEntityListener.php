<?php

namespace Solcre\SolcreFramework2\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\Event;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\ViewEvent;
use Solcre\SolcreFramework2\Extractor\CustomEntityExtractor;

class RenderEntityListener implements ListenerAggregateInterface
{

    /**
     *  Event manager
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * Array of listeners
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * Service locator instance
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Event manager
     *
     * @var EventManagerInterface
     */
    protected $events;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->acceptLanguages = [];
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Set the event manager instance
     *
     * @param  EventManagerInterface $events
     *
     * @return self
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers([
            __CLASS__,
            get_class($this),
        ]);

        $this->events = $events;

        return $this;
    }

    /**
     * Retrieve event manager
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    /**
     * Attach events
     *
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        if ($this->isHalEventManager($events)) {
            $this->listeners[] = $events->attach('renderEntity', array($this, 'onHalRenderEntity'));
        } else {
            if ($this->isViewEventManager($events)) {
                $this->listeners[] = $events->attach('renderEntity', array($this, 'onViewRenderEntity'), 202);
            }
        }
    }

    /**
     * Detach events
     *
     * @param EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * When Hal render an entity
     *
     * @param Event $e
     */
    public function onHalRenderEntity(Event $e)
    {
        $halPlugin = $this->serviceLocator->get('ControllerPluginManager')->get('Hal');
        //Get entity
        $halEntity = $e->getParam('entity');
        $entity = $halEntity->getEntity();

        //Trigger render
        $this->getEventManager()->trigger(RenderEntityEvent::EVENT_RENDER, $this, ['entity' => $entity]);

        //Clear cache
        if ($halPlugin->getEntityExtractor() instanceof CustomEntityExtractor) {
            //Clear cache from entity extractor
            $halPlugin->getEntityExtractor()->removeSerializedEntity($entity);
        }
    }

    /**
     * When View render an entity
     *
     * @param Event $e
     */
    public function onViewRenderEntity(Event $e)
    {
        //Get entity
        $entity = $e->getParam('entity');

        //Trigger render
        $this->getEventManager()->trigger(RenderEntityEvent::EVENT_RENDER, $this, ['entity' => $entity]);
    }

    /**
     * Is Hal event manager?
     *
     * @param EventManagerInterface $events
     *
     * @return bool
     */
    private function isHalEventManager(EventManagerInterface $events)
    {
        $halPlugin = $this->serviceLocator->get('ControllerPluginManager')->get('Hal');
        $identifiers = $events->getIdentifiers();

        return in_array(get_class($halPlugin), $identifiers);
    }

    /**
     * Is View event manager?
     *
     * @param EventManagerInterface $events
     *
     * @return bool
     */
    private function isViewEventManager(EventManagerInterface $events)
    {
        $view = $this->serviceLocator->get('View');
        $identifiers = $events->getIdentifiers();

        return in_array(get_class($view), $identifiers);
    }
}

?>