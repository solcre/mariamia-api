<?php

namespace Solcre\SolcreFramework2\ContentNegotiation;

use Zend\View\Model\ViewModel;
use ZF\Hal\Collection;
use ZF\Hal\Entity;

class PdfModel extends ViewModel
{

    protected $terminate = true;

    public function setTerminal($flag)
    {
        // Do nothing; should always terminate
        return $this;
    }

    /**
     * Does the payload represent a HAL collection?
     *
     * @return bool
     */
    public function isCollection()
    {
        $payload = $this->getPayload();
        return ($payload instanceof Collection);
    }

    /**
     * Does the payload represent a HAL entity?
     *
     * @return bool
     */
    public function isEntity()
    {
        $payload = $this->getPayload();
        return ($payload instanceof Entity);
    }

    /**
     * Retrieve the payload for the response
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->getVariable('payload');
    }
}

?>