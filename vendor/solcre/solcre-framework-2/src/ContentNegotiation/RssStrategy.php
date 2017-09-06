<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Solcre\SolcreFramework2\ContentNegotiation;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model\ViewModel;
use Zend\View\ViewEvent;

class RssStrategy extends AbstractListenerAggregate
{

    /**
     * @var ViewModel
     */
    protected $model;

    /**
     * @var RssRenderer
     */
    protected $renderer;

    /**
     * @param RssRenderer $renderer
     */
    public function __construct(RssRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param EventManagerInterface $events
     * @param int                   $priority
     */
    public function attach(EventManagerInterface $events, $priority = 200)
    {
        //Set event manager to renderer for renderEntity dispatch events
        if ($this->renderer instanceof CsvRenderer) {
            $this->renderer->setEventManager($events);
        }

        //Normal attach
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), 202);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * @param ViewEvent $e
     *
     * @return null|PdfRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        if (!$model instanceof RssModel) {
            return;
        }
        $this->model = $model;
        return $this->renderer;
    }

    /**
     * @param ViewEvent $e
     */
    public function injectResponse(ViewEvent $e)
    {
        if (!$this->model instanceof RssModel) {
            return;
        }

        $result = $e->getResult();

        if (!is_string($result)) {
            // We don't have a string, and thus, no JSON
            return;
        }
        $response = $e->getResponse();
        if (!method_exists($response, 'getHeaders')) {
            return;
        }

        // Populate response
        $response->setContent($result);
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/rss+xml');
    }
}
