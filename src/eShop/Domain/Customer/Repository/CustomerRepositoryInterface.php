<?php

namespace eShop\Domain\Customer\Repository;

interface CustomerRepositoryInterface
{
    public function create(string $email);
}
