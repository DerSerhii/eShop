<?php

namespace eShop\Domain\Product\ValueObject;


use InvalidArgumentException;

final class Price
{
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $this->validatePrice($price);
    }

    private function validatePrice($price): float|int|string
    {
        if (!is_numeric($price) || $price < 0) {
            throw new InvalidArgumentException(
                'Price must be a non-negative numeric value.'
            );
        }

        return $price;
    }

    public function getValue(): int
    {
        return $this->price;
    }
}
