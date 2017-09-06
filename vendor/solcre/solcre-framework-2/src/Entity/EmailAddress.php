<?php

namespace Solcre\SolcreFramework2\Entity;

use Zend\Validator\EmailAddress as EmailValidator;

class EmailAddress
{

    const TYPE_FROM = 1;
    const TYPE_TO = 2;
    const TYPE_CC = 3;
    const TYPE_BCC = 4;
    const TYPE_REPLAY_TO = 5;

    private $email;
    private $name;
    private $type;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function isValid()
    {
        $validator = new EmailValidator();
        return $validator->isValid($this->email);
    }

    function __construct($email = null, $name = null, $type = null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->type = $type;
    }

}
