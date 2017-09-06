<?php

namespace Solcre\SolcreFramework2\Extractor;

use ZF\Hal\Extractor\LinkCollectionExtractor;

class CustomLinkCollectionExtractor extends LinkCollectionExtractor
{

    protected $clientCode;

    public function getClientCode()
    {
        return $this->clientCode;
    }

    public function setClientCode($clientCode)
    {
        $this->clientCode = $clientCode;
    }

    public function extract(\ZF\Hal\Link\LinkCollection $collection)
    {
        $links = parent::extract($collection);

        if (is_array($links) && !empty($this->clientCode)) {
            $this->injectClientCode($links);
        }

        return $links;
    }

    protected function injectClientCode(array &$links)
    {
        foreach ($links as &$link) {
            if (is_array($link) && array_key_exists('href', $link)) {
                $link['href'] = preg_replace("/\.[a-z]*\//", "${0}/" . $this->clientCode . "/", $link['href']);
            }
        }
    }
}

?>