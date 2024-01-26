<?php

namespace eShop\Infrastructure\Customer\Repository;

use eShop\Domain\Customer\Entity\Customer;
use eShop\Domain\Customer\Repository\CustomerRepositoryInterface;
use eShop\Domain\Customer\ValueObject\Email;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function create(string $email): Customer
    {
        $emailObj = new Email($email);

        return new Customer($emailObj);
    }
}
