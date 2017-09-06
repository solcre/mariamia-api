<?php

namespace Solcre\SolcreFramework2\Hydrator;

/**
 * This hydrator has been completely refactored for DoctrineModule 0.7.0. It provides an easy and powerful way
 * of extracting/hydrator objects in Doctrine, by handling most associations types.
 *
 * Starting from DoctrineModule 0.8.0, the hydrator can be used multiple times with different objects
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @since   0.7.0
 * @author  Michael Gallego <mic.gallego@gmail.com>
 */
class EntityTranslationHydrator extends EntityHydrator
{

    protected function extractByValue($object)
    {
        $data = parent::extractByValue($object);
        $translations = $data['translations'];
        $translationsNormalized = [];
        // Get translations
        if (!empty($translations)) {
            foreach ($translations as $item) {
                $locale = $item->getLocale();
                $field = $item->getField();
                $content = $item->getContent();
                $translationsNormalized[$locale][$field] = $content;
            }
        }
        $data['translations'] = $translationsNormalized;
        return $data;
    }
}
