<?php

namespace App\Observers;


use eShop\Domain\Product\Model\ProductEloquent;

class ProductStorageObserver
{
    public function created(ProductEloquent $productStorageModel): void
    {
        info('created');
    }
}
