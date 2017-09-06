<?php

namespace Mariamia\V1\Rest\Sections;

class SectionsResourceFactory
{
    public function __invoke($services)
    {
        $sectionService = $services->get('Solcre\Mariamia\Service\SectionService');
        return new SectionsResource($sectionService);
    }
}
