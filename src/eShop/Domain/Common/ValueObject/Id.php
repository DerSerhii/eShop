<?php

namespace eShop\Domain\Common\ValueObject;

use InvalidArgumentException;

final class Id
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $this->validateId($id);
    }

    private function validateId($id): int
    {
        if (!is_int($id)) {
            throw new InvalidArgumentException( "'id' must be an integer.");
        }

        if ($id < 0) {
            throw new InvalidArgumentException("'id' must be greater than zero.");
        }
        return $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
