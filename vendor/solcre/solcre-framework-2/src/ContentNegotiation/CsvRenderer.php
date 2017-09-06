<?php

namespace Solcre\SolcreFramework2\ContentNegotiation;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\EventManager\EventManagerInterface;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\View\ApiProblemModel;
use ZF\ApiProblem\View\ApiProblemRenderer;

class CsvRenderer implements RendererInterface
{

    /**
     * @var ApiProblemRenderer
     */
    protected $apiProblemRenderer;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

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

    public function getEventManager()
    {
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function render($nameOrModel, $values = null)
    {
        $payload = $nameOrModel->getPayload();
        $headers = '';

        if ($nameOrModel instanceof CsvModel) {

            if ($nameOrModel->isCollection()) {

                $collection = $payload->getCollection();
                $arrayValues = array();

                foreach ($collection as $entity) {

                    if (empty($headers)) {
                        $headers = $this->substractHeaders($entity);
                    }

                    $arrayValues[] = $this->entityToCsv($entity);
                }

                $values = implode("\n", $arrayValues);
            }

            if ($nameOrModel->isEntity()) {

                $values = $this->entityToCsv($payload->getEntity());

                $headers = $this->substractHeaders($payload->getEntity());
            }
        }

        if ($payload instanceof ApiProblem) {
            return $this->renderApiProblem($payload);
        }

        return $headers . "\n" . $values;
    }

    protected function entityToArray($entity)
    {
        if (method_exists($entity, 'getArrayCopy')) {
            return $entity->getArrayCopy();
        }
    }

    protected function entityToCsv($entity)
    {
        if ($this->eventManager instanceof EventManagerInterface) {
            //Trigger render
            $this->getEventManager()->trigger('renderEntity', $this, ['entity' => $entity]);
        }

        //Entity to array
        $entityValues = $this->entityToArray($entity);

        if (is_array($entityValues)) {
            $values = implode(';', $entityValues);
        }

        return $values;
    }

    protected function substractHeaders($entity)
    {
        $entityValues = $this->entityToArray($entity);

        if (is_array($entityValues)) {
            $headers = implode(';', array_keys($entityValues));
        }

        return $headers;
    }

    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
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
