<?php

namespace Solcre\SolcreFramework2\Hydrator;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Doctrine\Common\Util\Inflector;
use ReflectionProperty;
use ReflectionClass;

class EntityHydrator extends DoctrineObject
{

    protected function extractByValue($object)
    {
        $data = parent::extractByValue($object);
        $entityFields = array_merge($this->metadata->getFieldNames(), $this->metadata->getAssociationNames());
        $fieldNames = $this->getIgnoredProperties($object, $entityFields);

        $methods = get_class_methods($object);
        foreach ($fieldNames as $fieldName) {
            $getter = 'get' . Inflector::classify($fieldName);
            $dataFieldName = $this->computeExtractFieldName($fieldName);

            if (in_array($getter, $methods)) {
                $data[$dataFieldName] = $this->extractValue($fieldName, $object->$getter(), $object);
            }
        }
        return $data;
    }

    private function getIgnoredProperties($object, $entityFields)
    {
        $reflect = new ReflectionClass($object);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        $propertiesArray = array();
        foreach ($properties as $property) {
            array_push($propertiesArray, $property->name);
        }
        return array_diff($propertiesArray, $entityFields);
    }
}
