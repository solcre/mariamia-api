<?php

namespace Solcre\Mariamia\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Solcre\Mariamia\Repository\ShopRepository") @ORM\Table(name="shops")
 */
class ShopEntity
{

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue * */
    protected $id;

    /** @ORM\Column(type="string") * */
    protected $name;

    /** @ORM\Column(type="string") * */
    protected $address;

    /** @ORM\Column(type="string") * */
    protected $latitude;

    /** @ORM\Column(type="string") * */
    protected $longitude;

    /** @ORM\Column(type="boolean") * */
    protected $stock;

    /** @ORM\Column(type="string", name="username") * */
    protected $email;

    /** @ORM\Column(type="string") * */
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}
