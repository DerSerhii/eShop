<?php

namespace eShop\Domain\Customer\Entity;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\Name;
use eShop\Domain\Customer\ValueObject\Email;

final class Customer
{
    private Id $id;
    private Name $name;
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }
}
