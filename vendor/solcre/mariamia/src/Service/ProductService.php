<?php

namespace Solcre\Mariamia\Service;

use Exception;
use \Solcre\Mariamia\Entity\ProductEntity;
use Solcre\SolcreFramework2\Service\BaseService;
use Solcre\SolcreFramework2\Utility\File;

class ProductService extends BaseService
{

    private $config;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager = null, $config)
    {
        $this->config = $config;
        parent::__construct($entityManager);
    }

    public function add($data, $strategies = null)
    {

        $product = $this->repository->ProductExists($data);
        if ($product > 0) {
            throw new Exception("Product already exists", 409);
        } else {
            $options = array(
                "target_dir" => $this->config['mariamia']['image_path'],
                "key"        => "image"
            );
            $name = $data['image']['name'];
            $image = explode(".", $name);
            $date = md5(date('Y-m-d H:i:s:u'));
            $data['image']['name'] = $image[0] . $date . "." . $image[1];
            $file = File::uploadFile($data, $options);
            $data['image'] = $file['name'];
            return parent::add($data, $strategies);
        }
    }

    public function put($id, $data)
    {

        $product = parent::fetch($id);
        if ($product instanceof ProductEntity) {

            $product->setName($data['name']);
            $product->setType($data['type']);
            $product->setThc($data['thc']);
            $product->setCbd($data['cbd']);
            $product->setDescription($data['description']);

            $isProduct = $this->repository->ProductExistsWithOtherId($id, $data);

            if ($isProduct > 0) {
                throw new Exception("ProductEntity already exists", 404);
            } else {
                $this->entityManager->flush();
                return $product;
            }
        }
    }

}
