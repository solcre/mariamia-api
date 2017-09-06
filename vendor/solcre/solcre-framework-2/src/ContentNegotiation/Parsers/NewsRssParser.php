<?php

namespace Solcre\SolcreFramework2\ContentNegotiation\Parsers;

use Solcre\Columnis\Entity\CategoryEntity;
use Solcre\Columnis\Entity\NewsEntity;
use Solcre\User\Entity\UserEntity;

class NewsRssParser implements RssParser
{

    protected $config;
    protected $columnisConfigurationService;

    /**
     * NewsRssParser constructor.
     *
     * @param $config
     * @param $columnisConfigurationService
     */
    public function __construct($config, $columnisConfigurationService)
    {
        $this->config = $config;
        $this->columnisConfigurationService = $columnisConfigurationService;
    }


    /**
     * @param NewsEntity $entity
     *
     * @return array
     */
    public function parseData($entity)
    {
        $author = $entity->getAuthor();
        $authorInfo = [];
        if ($author instanceof UserEntity) {
            $authorInfo = [
                'name'  => $author->getFullname(),
                'email' => $author->getEmail()
            ];
        }
        $category = $entity->getCategory();
        $categoryInfo = [];
        if ($category instanceof CategoryEntity) {
            $categoryInfo = [
                'term' => $category->getName()
            ];
        }

        $configurationEntity = $this->columnisConfigurationService->fetch(1);
        $link = null;
        $pageRssId = $configurationEntity->getPageRssId();
        if (!empty($pageRssId)) {
            $link = $this->config['columnis']['URL'] . '/' . $entity->getSlug() . '-' . $pageRssId . '?' . $entity->getIdParam();
        }

        return [
            'title'        => $entity->getTitle(),
            'link'         => $link,
            'description'  => $entity->getDescription(),
            'pubDate'      => $entity->getCreateDate(),
            'dateModified' => $entity->getLastUpdate(),
            'content'      => $entity->getContent(),
            'author'       => $authorInfo,
            'category'     => $categoryInfo,
            'commentCount' => $entity->getCommentCount(),
        ];
    }

    public function getRssChannelInfo()
    {
        return [
            'channel' => [
                'title'       => 'Noticias de ' . $this->config['columnis']['URL'],
                'link'        => $this->config['columnis']['URL'],
                'description' => 'Noticias de ' . $this->config['columnis']['URL'],
                'generator'   => 'Generador por ' . $this->config['columnis']['PRODUCT'] . ' ' . $this->config['columnis']['VERSION'],
            ]
        ];
    }
}


