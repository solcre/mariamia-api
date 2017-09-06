<?php

namespace Solcre\SolcreFramework2\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\Event;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\Common\Collections\Collection;
use \ArrayObject;
use ZF\Hal\Entity;
use ZF\Hal\Plugin\Hal;
use Solcre\SolcreFramework2\Collection\PaginatedCollection;

class PostRenderEntityListener implements ListenerAggregateInterface
{

    const EMBEDDED_PAGER_KEY = "_embeddedPager";

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
     *
     * @var Hal
     */
    protected $halPlugin;

    public function __construct(Hal $halPlugin)
    {
        $this->halPlugin = $halPlugin;
    }

    /**
     * Attach events
     *
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('renderEntity.post', array($this, 'onPostRenderEntity'));
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
    public function onPostRenderEntity(Event $e)
    {
        $payload = $e->getParam('payload');
        $entity = $e->getParam('entity');

        //Check types first
        if ($entity instanceof Entity && $payload instanceof ArrayObject) {
            $this->processEntity($entity, $payload);
        }
    }

    /**
     * For each embedded check type and inject embedded pager
     *
     * @param Entity      $halEntity
     * @param ArrayObject $payload
     */
    protected function processEntity(Entity $halEntity, ArrayObject &$payload)
    {
        $embedded = $payload->offsetGet('_embedded');
        $entityExtracted = $this->extractEntity($halEntity);
        $fields = [];
        $embeddedPager = [];

        //Extractct embedded keys
        if (is_array($embedded)) {
            $fields = array_keys($embedded);
        }

        //Check and for each field check type
        if (is_array($fields) && count($fields)) {
            foreach ($fields as $field) {
                //Getter exist
                if (array_key_exists($field, $entityExtracted)) {
                    //Get embedded
                    $value = $entityExtracted[$field];

                    //Is a collection proccessed by ExpandEmbeddedStrategy?
                    if ($value instanceof PaginatedCollection) {
                        $embeddedPager[$field] = [
                            "page_count"  => $value->getPageCount(),
                            "page_size"   => $value->getPageSize(),
                            "total_items" => $value->getTotalItems(),
                            "page"        => $value->getPage()
                        ];
                    } //Is normal collection?
                    else {
                        if ($value instanceof Collection) {
                            $count = $value->count();
                            $embeddedPager[$field] = [
                                "page_count"  => 1,
                                "page_size"   => $count,
                                "total_items" => $count,
                                "page"        => 1
                            ];
                        }
                    }
                }
            }
        }
        //Inject embedded pager
        if (count($embeddedPager)) {
            $payload->offsetSet(self::EMBEDDED_PAGER_KEY, $embeddedPager);
        }
    }

    /**
     * Run this for getting the values with strategies executed
     * It gets the entity from entityExtrator cache
     *
     * @param Entity $halEntity
     *
     * @return array
     */
    protected function extractEntity(Entity $halEntity)
    {
        $entityExtracotor = $this->halPlugin->getEntityExtractor();
        $entity = $halEntity->getEntity();
        return $entityExtracotor->extract($entity);
    }
}

?>