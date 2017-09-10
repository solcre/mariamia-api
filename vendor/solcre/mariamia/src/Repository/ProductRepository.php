<?php

namespace Solcre\Mariamia\Repository;

use \Solcre\SolcreFramework2\Common\BaseRepository;

class ProductRepository extends BaseRepository
{

    public function ProductExists($data)
    {

        $qb = $this->_em->createQueryBuilder();

        $qb->select('count(p.id)')
            ->from('Solcre\Mariamia\Entity\ProductEntity', 'p')
            ->where('p.name =:name')
            ->setParameter('name', $data['name']);

        return $qb->getQuery()->getSingleScalarResult();

    }

    public function ProductExistsWithOtherId($id, $data)
    {

        $qb = $this->_em->createQueryBuilder();

        $qb->select('count(p.id)')
            ->from('Solcre\Mariamia\Entity\ProductEntity', 'p')
            ->where('p.id !=:id')
            ->andWhere('p.name =:name')
            ->setParameter('id', $id)
            ->setParameter('name', $data['name']);

        return $qb->getQuery()->getSingleScalarResult();

    }
}
