<?php

namespace Solcre\Mariamia\Repository;

use \Solcre\SolcreFramework2\Common\BaseRepository;

class SectionRepository extends BaseRepository
{

    public function SectionExists($data)
    {

        $qb = $this->_em->createQueryBuilder();

        $qb->select('count(s.id)')
            ->from('Solcre\Mariamia\Entity\SectionEntity', 's')
            ->where('s.title =:title')
            ->setParameter('title', $data['title']);

        return $qb->getQuery()->getSingleScalarResult();

    }

    public function SectionExistsWithOtherId($id, $data)
    {

        $qb = $this->_em->createQueryBuilder();

        $qb->select('count(s.id)')
            ->from('Solcre\Mariamia\Entity\SectionEntity', 's')
            ->where('s.id !=:id')
            ->andWhere('s.title =:title')
            ->setParameter('id', $id)
            ->setParameter('title', $data['title']);

        return $qb->getQuery()->getSingleScalarResult();

    }

}

