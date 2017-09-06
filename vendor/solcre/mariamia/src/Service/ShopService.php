<?php

namespace Solcre\Mariamia\Service;

use Solcre\SolcreFramework2\Service\BaseService;
use Exception;
use Solcre\Mariamia\Entity\ShopEntity;
use \Solcre\SolcreFramework2\Utility\Strings;

class ShopService extends BaseService
{

    public function add($data, $strategies = null)
    {

        $password = $data['password'];
        $data['password'] = Strings::bcryptPassword($password);
        $shop = $this->repository->shopExists($data);
        if ($shop > 0) {
            throw new Exception("Shop already exists", 409);
        } else {
            return parent::add($data, $strategies);
        }

    }

    public function put($id, $data)
    {

        $shop = parent::fetch($id);
        if ($shop instanceof ShopEntity) {
            $shop->setName($data['name']);
            $shop->setAddress($data['address']);
            $shop->setLatitude($data['latitude']);
            $shop->setLongitude($data['longitude']);
            $shop->setStock($data['stock']);
            $shop->setEmail($data['email']);
            $password = Strings::bcryptPassword($data['password']);
            $shop->setPassword($password);

            $shop = $this->repository->shopExists($data, $id);
            if ($shop > 0) {
                throw new Exception("ShopEntity already exists", 404);
            } else {
                $this->entityManager->flush();
                return $shop;
            }
        } else {
            throw new Exception("ShopEntity not found", 404);
        }
    }

    public function patch($id, $data)
    {

        $shop = parent::fetch($id);
        if ($shop instanceof ShopEntity) {
            if (isset($data['stock'])) {
                $shop->setStock($data['stock']);
                $this->entityManager->flush();
                return $shop;
            }
        } else {
            throw new Exception("ShopEntity not found", 404);
        }
    }

}
