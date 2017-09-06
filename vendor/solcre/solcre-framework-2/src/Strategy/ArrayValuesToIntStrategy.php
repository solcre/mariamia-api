<?php

namespace Solcre\SolcreFramework2\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class ArrayValuesToIntStrategy implements StrategyInterface
{
    public function extract($value)
    {
        return;
    }

    public function hydrate($value)
    {
        $result = [];
        if (is_array($value)) {
            foreach ($value as $val) {
                if (is_numeric($val)) {
                    $result[] = (int)$val;
                }
            }
        }
        return $result;
    }
}
