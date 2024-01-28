<?php

namespace eShop\Domain\Common\ValueObject;

use InvalidArgumentException;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $this->validateName($name);
    }

    private function validateName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Name cannot be empty.');
        }
        return $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }
}
