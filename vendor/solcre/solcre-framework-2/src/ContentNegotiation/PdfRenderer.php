<?php

namespace Solcre\SolcreFramework2\ContentNegotiation;

use Solcre\Columnis\Service\ConfigurationService;
use Solcre\SolcreFramework2\Utility\Pdf;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\JsonRenderer;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\ViewEvent;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\View\ApiProblemModel;
use ZF\ApiProblem\View\ApiProblemRenderer;
use ZF\Hal\Plugin\Hal;

class PdfRenderer extends JsonRenderer
{

    /**
     * @var ApiProblemRenderer
     */
    protected $apiProblemRenderer;

    /**
     * @var \TCPDF
     */
    protected $tcpdf;

    /**
     * @var \Smarty
     */
    protected $smarty;

    /**
     * @var Pdf
     */
    protected $pdfUtility;

    /**
     * @var ConfigurationService
     */
    protected $columnisConfigurationService;

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
     * @var array
     */
    protected $config;

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
     * @param ApiProblemRenderer      $apiProblemRenderer
     * @param \TCPDF                  $tcpdf
     * @param \Smarty                 $smarty
     * @param Pdf                     $pdfUtility
     * @param ServiceLocatorInterface $serviceLocator
     * @param array                   $config
     * @param ConfigurationService    $columnisConfigurationService
     */
    public function __construct(
        ApiProblemRenderer $apiProblemRenderer,
        \TCPDF $tcpdf,
        \Smarty $smarty,
        Pdf $pdfUtility,
        ServiceLocatorInterface $serviceLocator,
        $config,
        ConfigurationService $columnisConfigurationService
    ) {
        $this->apiProblemRenderer = $apiProblemRenderer;
        $this->tcpdf = $tcpdf;
        $this->smarty = $smarty;
        $this->pdfUtility = $pdfUtility;
        $this->serviceLocator = $serviceLocator;
        $this->config = $config;
        $this->columnisConfigurationService = $columnisConfigurationService;
    }

    public function getEngine()
    {
        return $this;
    }

    public function render($nameOrModel, $values = null)
    {
        $payload = $nameOrModel->getPayload();
        if ($nameOrModel instanceof PdfModel) {
            $arrayResults = [];
            /* @var $helper Hal */
            $helper = $this->helpers->get('Hal');
            if ($nameOrModel->isEntity()) {
                $entity = $payload->getEntity();
                $entity = $helper->renderEntity($payload, $entity->getId());
                $arrayResults[] = $this->processEntity($entity);
            }
            if ($nameOrModel->isCollection()) {
                $collection = $helper->renderCollection($payload);
                $collection = array_values($collection['_embedded'])[0];
                if (count($collection) > 0) {
                    foreach ($collection as $entity) {
                        $arrayResults[] = $this->processEntity($entity);
                    }
                }
            }
            $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $footer = 'Generado con ' . $this->config['columnis']['PRODUCT'] . ' ' . $this->config['columnis']['VERSION']
                . ' www.solcre.com';
            $pdf->SetCreator($footer);
            $pdf->SetHeaderData($arrayResults[0]['header']['logo'], 65, "", $arrayResults[0]['header']['headerString']);
            $pdf->SetMargins(10, 30, 10);
            $pdf->SetFont('helvetica', 'R', 10);
            foreach ($arrayResults as $result) {
                foreach ($result['pages'] as $page) {
                    $pdf->setJPEGQuality(100);
                    $pdf->addPage();
                    $pdf->writeHTML($page, true, 0, true, 0);
                }
            }
            $pdf->Output($arrayResults[0]['title'], 'I');
            exit;
        }
        $headers = '';
        if ($payload instanceof ApiProblem) {
            return $this->renderApiProblem($payload);
        }

        return $headers . "\n" . $values;
    }

    protected function processEntity($entity)
    {
        if ($this->eventManager instanceof EventManagerInterface) {
            //Trigger render
            $this->getEventManager()->trigger('renderEntity', $this, ['entity' => $entity]);
        }
        $entityArray = parent::render($entity);
        $data = json_decode($entityArray, true);
        return $this->processData($data);
    }

    public function processData(Array $data)
    {
        $header = [];
        $config = [
            'img_url'               => realpath($this->config['columnis']['PATHS']['pictures']) . "/",
            'templates_url_default' => realpath($this->config['columnis']['PATHS']['templates_default'])
        ];
        $templates = ['default_template.tpl'];
        $this->smarty->setTemplateDir($config['templates_url_default']);
        $titles = $this->getTitles();
        $this->smarty->assign("data", $data);
        $this->smarty->assign("titles", $titles);
        $this->smarty->assign("config", $config);
        $header = $this->processHeaderInformation($header);
        $title = $data['id'];
        $pages = $this->createPages($data, $templates);
        return $result = [
            'header' => $header,
            'title'  => $title,
            'pages'  => $pages
        ];
    }

    private function createPages($data, $templates)
    {
        $pages[] = $this->smarty->fetch($templates[0]);
        return $pages;
    }

    private function processHeaderInformation($header)
    {
        $columnisConfiguration = $this->columnisConfigurationService->fetch(1);
        $email = $columnisConfiguration->getEmail();
        $site = $this->config['columnis']['URL'];
        $header['headerString'] = $email . "\n" . $site;
        return $header;
    }

    private function getTitles()
    {
        $path = $this->config['columnis']['PATHS']['lang'] . 'es.txt';
        if (file_exists($path)) {
            $langFile = fopen($path, 'r');
            $titles = [];
            while ($line = fgets($langFile)) {
                $titles[] = html_entity_decode($line);
            }
            fclose($langFile);
            return $titles;
        }
        return [];
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
