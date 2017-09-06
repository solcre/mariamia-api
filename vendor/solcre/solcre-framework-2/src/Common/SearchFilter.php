<?php

namespace Solcre\SolcreFramework2\Common;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SearchFilter extends SQLFilter
{

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {

        //Check parameter first
        if ($this->hasParameter('query')) {
            $searchTerm = trim($this->getParameter('query'), "'");

            //Empty search term return empty string
            if (empty($searchTerm)) {
                return '';
            }

            //Get searchable fields
            $searchableFields = $this->getSearchableFields($targetEntity);

            //Init value false
            $whereApplied = false;

            //Check searchable fields
            if (is_array($searchableFields) && count($searchableFields)) {
                //Create critera obj
                $sql = '';

                foreach ($searchableFields as $field) {

                    $like = sprintf("%s.%s LIKE '%%%s%%'", $targetTableAlias, $field, $searchTerm);

                    if (!$whereApplied) {
                        //First must be a where others addWhere
                        $whereApplied = true;

                        $sql = $like;
                    } else {
                        $sql .= sprintf(" OR %s", $like);
                    }
                }
            } else {
                return '';
            }
        }
        return $sql;
    }

    private function getSearchableFields(ClassMetadata $metaData)
    {
        $searchableFields = [];

        $fieldMappings = $metaData->fieldMappings;

        //Check field mappings
        if (is_array($fieldMappings) && count($fieldMappings)) {
            foreach ($fieldMappings as $key => $field) {

                //Check searchable options
                if (is_array($field) && is_array($field['options']) && isset($field['options']['searchable'])
                    && $field['options']['searchable']) {
                    $searchableFields[] = $field['columnName'];
                }
            }
        }
        return $searchableFields;
    }
}

?>