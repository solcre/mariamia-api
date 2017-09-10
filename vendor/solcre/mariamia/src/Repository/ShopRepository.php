<?php

namespace Solcre\Mariamia\Repository;

use \Solcre\SolcreFramework2\Common\BaseRepository;

class ShopRepository extends BaseRepository
{

    public function shopExists($data, $id = null)
    {

        $qb = $this->_em->createQueryBuilder();


        $qb->select('count(s.id)')
            ->from('Solcre\Mariamia\Entity\ShopEntity', 's')
            ->where('s.email =:email OR (s.latitude =:latitude AND s.longitude =:longitude)')
            ->setParameter('email', $data['email'])
            ->setParameter('latitude', $data['latitude'])
            ->setParameter('longitude', $data['longitude']);

        if ($id != null) {
            $qb->andWhere('s.id !=:id')
                ->setParameter('id', $id);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

}
