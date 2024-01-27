<?php

namespace eShop\Domain\Order\ValueObject;

use InvalidArgumentException;

final class OrderBonus
{
    private float $bonus;

    public function __construct(float $bonus)
    {
        $this->bonus = $this->validateBonus($bonus);
    }

    private function validateBonus($bonus): float|int|string
    {
        if (!is_numeric($bonus) || $bonus < 0) {
            throw new InvalidArgumentException(
                'Bonus must be a non-negative numeric value.');
        }

        return $bonus;
    }

    public function getValue(): float
    {
        return $this->bonus;
    }
}
