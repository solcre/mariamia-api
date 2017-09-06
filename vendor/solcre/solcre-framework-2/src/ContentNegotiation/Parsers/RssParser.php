<?php
/**
 * Created by PhpStorm.
 * User: diegosorribas
 * Date: 04/07/17
 * Time: 10:22 AM
 */

namespace Solcre\SolcreFramework2\ContentNegotiation\Parsers;


interface RssParser
{
    public function parseData($entity);

    public function getRssChannelInfo();

}