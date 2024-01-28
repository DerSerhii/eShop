<?php

namespace eShop\Domain\Order\Settings;

class OrderSettings
{
    public function getBonusThreshold(): float
    {
        return config('shop.bonus_threshold', 100);
    }

    public function getDiscount(): float
    {
        return config('shop.discount', 5);
    }
}
