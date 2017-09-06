<?php

namespace Solcre\SolcreFramework2\Utility;

use DateTime;

class Date
{

    public static function current()
    {
        return new DateTime("NOW");
    }

}
