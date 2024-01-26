<?php

namespace eShop\Domain\Product\ValueObject;

use InvalidArgumentException;

final class ProductQuantity
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $this->validateQuantity($quantity);
    }

    private function validateQuantity($quantity): int
    {
        if (!is_int($quantity)) {
            throw new InvalidArgumentException(
                'Quantity must be an integer.'
            );
        }

        if ($quantity <= 0) {
            throw new InvalidArgumentException(
                'The quantity must be greater than or equal to zero.'
            );
        }

        return $quantity;
    }

    public function getValue(): int
    {
        return $this->quantity;
    }
}
