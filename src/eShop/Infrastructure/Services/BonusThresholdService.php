<?php

namespace eShop\Infrastructure\Services;

class BonusThresholdService
{
    private float $bonusThreshold;

    public function __construct()
    {
        $this->bonusThreshold = config('shop.bonus_threshold', 100);
    }

    public function getBonusThreshold(): float
    {
        return $this->bonusThreshold;
    }

}
