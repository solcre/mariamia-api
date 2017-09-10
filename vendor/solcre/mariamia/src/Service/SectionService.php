<?php

namespace Solcre\Mariamia\Service;

use Exception;
use Solcre\Mariamia\Entity\SectionEntity;
use Solcre\SolcreFramework2\Service\BaseService;

class SectionService extends BaseService
{

    public function add($data, $strategies = null)
    {
        $data['usefulYes'] = 0;
        $data['usefulNo'] = 0;
        $section = $this->repository->SectionExists($data);
        if ($section > 0) {
            throw new Exception("Section already exists", 409);
        } else {
            return parent::add($data, $strategies);
        }

    }

    public function put($id, $data)
    {

        $section = parent::fetch($id);
        if ($section instanceof SectionEntity) {

            $section->setTitle($data['title']);
            $section->setContent($data['content']);
            $section->setUsefulYes($data['usefulYes']);
            $section->setUsefulNo($data['usefulNo']);

            $isSection = $this->repository->SectionExistsWithOtherId($id, $data);

            if ($isSection > 0) {
                throw new Exception("SectionEntity already exists", 404);
            } else {
                $this->entityManager->flush();
                return $section;
            }
        }

    }

    public function patch($id, $data)
    {

        $section = parent::fetch($id);
        if ($section instanceof SectionEntity) {
            if ($data['usefulYes'] == true) {
                $usefulYes = $section->getUsefulYes();
                $usefulYes++;
                $section->setUsefulYes($usefulYes);
            }
            if ($data['usefulNo'] == true) {
                $usefulNo = $section->getUsefulNo();
                $usefulNo++;
                $section->setUsefulNo($usefulNo);
            }

            $this->entityManager->flush();
            return $section;
        }

    }

}
