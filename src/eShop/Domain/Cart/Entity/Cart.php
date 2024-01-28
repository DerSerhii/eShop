<?php

namespace eShop\Domain\Cart\Entity;

use eShop\Domain\Common\ValueObject\Email;
use eShop\Domain\Common\ValueObject\Id;

final class Cart
{
    private Id $id;
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

}
