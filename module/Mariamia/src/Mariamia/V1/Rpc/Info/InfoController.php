<?php

namespace Mariamia\V1\Rpc\Info;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use \Solcre\Mariamia\Service\ShopService;
use Solcre\Mariamia\Entity\ShopEntity;

class InfoController extends AbstractActionController
{

    private $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function infoAction()
    {
        $userLogged = $this->getLoggedUserId();
        $shopEntity = $this->shopService->fetchBy(array('email' => $userLogged));
        if ($shopEntity instanceof ShopEntity) {
            return array(
                'id'    => $shopEntity->getId(),
                'name'  => $shopEntity->getName(),
                'stock' => $shopEntity->getStock()
            );
        } else {
            return new ApiProblemResponse(new ApiProblem(404, 'Shop not found'));
        }
    }

    private function getLoggedUserId()
    {
        $identity = $this->getIdentity();
        $identityData = $identity->getAuthenticationIdentity();
        return $identityData['user_id'];
    }

}
