<?php

namespace Solcre\SolcreFramework2\Extractor;

use SplObjectStorage;
use ZF\Hal\Extractor\EntityExtractor;

class CustomEntityExtractor extends EntityExtractor
{

    /**
     * Clear previous serialized entity
     *
     * @param mixed $entity
     */
    public function removeSerializedEntity($entity)
    {
        if (is_object($entity) && isset($this->serializedEntities[$entity])) {
            unset($this->serializedEntities[$entity]);
        }
    }

    /**
     * Clear serialized entities cache
     */
    public function clearSerializedEntities()
    {
        $this->serializedEntities = new SplObjectStorage();
    }
}

?>