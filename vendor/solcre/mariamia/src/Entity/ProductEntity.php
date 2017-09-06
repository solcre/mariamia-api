<?php

namespace Solcre\Mariamia\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Solcre\Mariamia\Repository\ProductRepository") @ORM\Table(name="products")
 */
class ProductEntity
{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue * */
    protected $id;

    /** @ORM\Column(type="string") * */
    protected $name;

    /** @ORM\Column(type="string") * */
    protected $type;

    /** @ORM\Column(type="string") * */
    protected $thc;

    /** @ORM\Column(type="string") * */
    protected $cbd;

    /** @ORM\Column(type="string") * */
    protected $description;

    /** @ORM\Column(type="string") * */
    protected $image;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getThc()
    {
        return $this->thc;
    }

    public function getCbd()
    {
        return $this->cbd;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setThc($thc)
    {
        $this->thc = $thc;
    }

    public function setCbd($cbd)
    {
        $this->cbd = $cbd;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

}
