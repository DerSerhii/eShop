<?php

namespace eShop\Domain\Order\ValueObject;

use InvalidArgumentException;

final class OrderTotal
{
    private int $total;

    public function __construct(int $total)
    {
        $this->total = $this->validateTotal($total);
    }

    private function validateTotal($total): float|int|string
    {
        if (!is_numeric($total) || $total < 0) {
            throw new InvalidArgumentException(
                'Total sum must be a non-negative numeric value.');
        }
        return $total;
    }

    public function getValue(): int
    {
        return $this->total;
    }
}
