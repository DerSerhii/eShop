<?php

namespace eShop\Infrastructure\Customer\Service;


use eShop\Domain\Customer\Entity\Customer;
use eShop\Domain\Customer\Service\CustomerServiceInterface;
use eShop\Infrastructure\Customer\Repository\CustomerRepository;

class CustomerService implements CustomerServiceInterface
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ) {
    }

    public function add(string $email): Customer
    {
        return $this->customerRepository->create($email);
    }
}
