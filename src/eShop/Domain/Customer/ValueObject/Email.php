<?php

namespace eShop\Domain\Customer\ValueObject;

use InvalidArgumentException;

final class Email
{
    private string $email;

    public function __construct($email)
    {
        $this->email = $this->validateEmail($email);
    }

    private function validateEmail($email)
    {
        $validatedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($validatedEmail === false) {
            throw new InvalidArgumentException('Invalid email address.');
        }
        return $email;
    }

    public function getValue(): string
    {
        return $this->email;
    }
}
