<?php

namespace eShop\Domain\Cart\Repository;


use eShop\Domain\Common\ValueObject\Email;

interface CartRepositoryInterface
{
    public function create(Email $email);
}
