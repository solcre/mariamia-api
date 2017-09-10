<?php

namespace Solcre\Mariamia\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Solcre\Mariamia\Repository\SectionRepository") @ORM\Table(name="sections")
 */
class SectionEntity
{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue * */
    protected $id;

    /** @ORM\Column(type="string") * */
    protected $title;

    /** @ORM\Column(type="text") * */
    protected $content;

    /** @ORM\Column(type="integer", name="useful_yes") * */
    protected $usefulYes;

    /** @ORM\Column(type="integer", name="useful_no") * */
    protected $usefulNo;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUsefulYes()
    {
        return $this->usefulYes;
    }

    public function getUsefulNo()
    {
        return $this->usefulNo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setUsefulYes($usefulYes)
    {
        $this->usefulYes = $usefulYes;
    }

    public function setUsefulNo($usefulNo)
    {
        $this->usefulNo = $usefulNo;
    }

}
