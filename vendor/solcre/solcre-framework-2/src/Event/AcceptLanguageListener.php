<?php

namespace Solcre\SolcreFramework2\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\Event;
use ZF\ContentNegotiation\Request;
use Zend\Http\Header\AcceptLanguage;
use Zend\Http\Header\Accept\FieldValuePart\LanguageFieldValuePart;
use Solcre\SolcreFramework2\Entity\TranslationEntityInterface;
use Solcre\SolcreFramework2\Event\RenderEntityEvent;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

class AcceptLanguageListener implements ListenerAggregateInterface
{

    const ACCEPT_ALL_TRANSLATIONS = '*';

    protected $listeners = [];
    protected $acceptLanguages;
    protected $request;
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->acceptLanguages = [];
        $this->serviceLocator = $serviceLocator;

        $this->prepareAcceptLanguages();
    }

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(RenderEntityEvent::EVENT_RENDER, array($this, 'renderEntityListener'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function renderEntityListener(Event $e)
    {
        $entity = $e->getParam('entity');

        if ($entity instanceof TranslationEntityInterface) {
            //Prepare accept languaes
            $this->prepareAcceptLanguages();

            if (!$this->acceptAllTranslations()) {
                //Must translate the entity?
                if ($this->mustTranslateEntity()) {
                    //Translate entity
                    $this->translateEntity($entity);
                } else {
                    //Filter translations
                    $this->filterEntityTranslations($entity);
                }
            }
        }
    }

    protected function translateEntity(TranslationEntityInterface &$entity)
    {
        $language = array_shift($this->acceptLanguages);
        $translations = $entity->getTranslations();
        /* @var $translations \Doctrine\ORM\PersistentCollection */

        if (!empty($translations)) {
            $translations = $translations->toArray();

            //Filter array
            $translations = array_filter($translations, function ($t) use ($language) {
                if ($t instanceof AbstractPersonalTranslation) {
                    return ($t->getLocale() == $language);
                }
                return false;
            });

            //Apply the filtered translations
            foreach ($translations as $translationEntity) {
                /* @var $translationEntity AbstractPersonalTranslation */
                $setter = "set" . ucfirst($translationEntity->getField());

                //translate entity
                if (method_exists($entity, $setter)) {
                    $entity->$setter($translationEntity->getContent());
                }
            }
        }
    }

    protected function filterEntityTranslations(TranslationEntityInterface &$entity)
    {
        $translations = $entity->getTranslations();
        /* @var $translations \Doctrine\ORM\PersistentCollection */

        if (!empty($translations)) {
            $translations = $translations->toArray();

            foreach ($translations as $translation) {
                if ($translation instanceof AbstractPersonalTranslation) {
                    if (!in_array($translation->getLocale(), $this->acceptLanguages)) {
                        $entity->removeTranslation($translation);
                    }
                }
            }
        }
    }

    protected function prepareAcceptLanguages()
    {
        $this->acceptLanguages = [];
        $request = $this->serviceLocator->get("Request");

        if ($request instanceof Request) {
            $acceptLanguage = $request->getHeader('Accept-Language');

            if ($acceptLanguage instanceof AcceptLanguage) {
                $parts = $acceptLanguage->getPrioritized();

                if (is_array($parts)) {
                    foreach ($parts as $part) {
                        /* @var $part  LanguageFieldValuePart */
                        $this->acceptLanguages[] = $part->getLanguage();
                    }
                }
            }
        }
    }

    protected function mustTranslateEntity()
    {
        return (count($this->acceptLanguages) === 1);
    }

    protected function acceptAllTranslations()
    {
        return (in_array(self::ACCEPT_ALL_TRANSLATIONS, $this->acceptLanguages));
    }
}

?>