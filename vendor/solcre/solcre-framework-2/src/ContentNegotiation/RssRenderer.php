<?php

namespace Solcre\SolcreFramework2\ContentNegotiation;

use ReflectionClass;
use Solcre\SolcreFramework2\ContentNegotiation\Parsers\RssParser;
use Zend\EventManager\EventManagerInterface;
use Zend\Feed\Writer\Feed;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\JsonRenderer;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\ViewEvent;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\View\ApiProblemModel;
use ZF\ApiProblem\View\ApiProblemRenderer;

class RssRenderer extends JsonRenderer
{

    const parsersNamespace = 'Solcre\SolcreFramework2\ContentNegotiation\Parsers';

    /**
     * @var ApiProblemRenderer
     */
    protected $apiProblemRenderer;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @var HelperPluginManager
     */
    protected $helpers;

    /**
     * @var ViewEvent
     */
    protected $viewEvent;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @param ApiProblemRenderer $apiProblemRenderer
     */
    public function __construct(ApiProblemRenderer $apiProblemRenderer)
    {
        $this->apiProblemRenderer = $apiProblemRenderer;
    }

    public function getEngine()
    {
        return $this;
    }

    public function render($nameOrModel, $values = null)
    {
        try {
            $payload = $nameOrModel->getPayload();
            if ($nameOrModel instanceof RssModel) {
                if ($nameOrModel->isEntity()) {
                    $parser = $this->getParser($payload->getEntity());
                    $dataRss = $this->getChannelInfo($parser);
                    $dataRss['items'][] = $parser->parseData($payload->getEntity());
                }

                if ($nameOrModel->isCollection()) {
                    $collection = $payload->getCollection();
                    if ($collection->count() > 0) {
                        foreach ($collection as $entity) {
                            if (empty($parser)) {
                                $parser = $this->getParser($entity);
                                $dataRss = $this->getChannelInfo($parser);
                            }
                            $dataRss['items'][] = $parser->parseData($entity);
                        }

                    }
                }
            }
            return $this->createRss($dataRss);
        } catch (\Exception $e) {
            return $this->renderApiProblem(new ApiProblem($e->getCode(), $e->getMessage()));
        }
    }

    private function getChannelInfo(RssParser $parser)
    {
        $dataRss = $parser->getRssChannelInfo();
        $this->validateChannelData($dataRss);
        return $dataRss;
    }

    private function getParser($entity)
    {
        try {
            $className = (new ReflectionClass($entity))->getShortName();
            $entityName = substr($className, 0, strpos($className, "Entity"));
            $parser = $this->serviceLocator->get(self::parsersNamespace . '\\' . $entityName . 'RssParser');

            if (!$parser instanceof RssParser) {
                throw new \Exception('Parser must implement RssParser interface', 400);
            }
            return $parser;
        } catch (\Exception $e) {
            throw new \Exception('Must provide a parser', 400);
        }

    }

    private function validateChannelData($data)
    {
        if (!array_key_exists('channel', $data) && !is_array($data['channel'])) {
            throw  new \Exception('Must provide channel information array', 422);
        }

        $requiredKeys = [
            'title',
            'link',
            'description'
        ];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data['channel'])) {
                throw  new \Exception('Must provide title, link and description for rss data', 422);
                break;
            }
            if (empty($data['channel'][$key])) {
                throw  new \Exception('The ' . $key . ' cannot be empty', 422);
                break;
            }
        }
    }

    private function createRss($data)
    {
        try {
            $feed = new Feed();
            $feed->setTitle($data['channel']['title']);
            $feed->setLink($data['channel']['link']);
            $feed->setDescription($data['channel']['description']);
            $feed->setGenerator($data['channel']['generator']);

            $latest = new \DateTime('NOW');

            if (!empty($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $entityData) {
                    $entry = $feed->createEntry();
                    if (!empty($entityData['title'])) {
                        $entry->setTitle($entityData['title']);
                    }

                    if (!empty($entityData['link'])) {
                        $entry->setLink($entityData['link']);
                    }

                    if (!empty($entityData['description'])) {
                        $entry->setDescription($entityData['description']);
                    }

                    if (!empty($entityData['pubDate']) && $entityData['pubDate'] instanceof \DateTime) {
                        $entry->setDateCreated($entityData['pubDate']);
                    }

                    if (!empty($entityData['dateModified']) && $entityData['dateModified'] instanceof \DateTime) {
                        $entry->setDateModified($entityData['dateModified']);
                        $modified = $entityData['dateModified'];
                    }

                    if (!empty($entityData['content'])) {
                        $entry->setContent($entityData['content']);
                    }
                    if (!empty($entityData['author'])) {
                        $entry->addAuthor($entityData['author']);
                    }
                    if (!empty($entityData['category'])) {
                        $entry->addCategory($entityData['category']);
                    }

                    if (!empty($entityData['commentCount'])) {
                        $entry->setCommentCount($entityData['commentCount']);
                    }

                    $feed->addEntry($entry);

                    if (!empty($modified)) {
                        $latest = $modified > $latest ? $modified : $latest;
                    }
                }
            }
            $feed->setDateModified($latest);
            return $feed->export('rss');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 404);
        }
    }

    public function setHelperPluginManager(HelperPluginManager $helpers)
    {
        $this->helpers = $helpers;
    }

    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    public function getViewEvent()
    {
        return $this->viewEvent;
    }

    /**
     * @param  ViewEvent $event
     *
     * @return self
     */
    public function setViewEvent(ViewEvent $event)
    {
        $this->viewEvent = $event;
        return $this;
    }

    public function getEventManager()
    {
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Render an API-Problem result
     *
     * Creates an ApiProblemModel with the provided ApiProblem, and passes it
     * on to the composed ApiProblemRenderer to render.
     *
     * If a ViewEvent is composed, it passes the ApiProblemModel to it so that
     * the ApiProblemStrategy can be invoked when populating the response.
     *
     * @param  ApiProblem $problem
     *
     * @return string
     */
    protected function renderApiProblem(ApiProblem $problem)
    {
        $model = new ApiProblemModel($problem);
        $event = $this->getViewEvent();
        if ($event) {
            $event->setModel($model);
        }

        return $this->apiProblemRenderer->render($model);
    }
}
