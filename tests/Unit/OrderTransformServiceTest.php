<?php

namespace Tests\Unit;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\Name;
use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Customer\Entity\Customer;
use eShop\Domain\Customer\ValueObject\Email;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Entity\ProductOrder;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;
use eShop\Domain\Product\ValueObject\ProductQuantity;
use eShop\Infrastructure\Services\OrderTransformService;
use Tests\TestCase;

class OrderTransformServiceTest extends TestCase
{
    public function testToArray(): void
    {
        $customerEmail = new Email('customer@mail.com');
        $customer = new Customer($customerEmail);

        $orderTotal = new OrderTotal(200);
        $orderBonus = new OrderBonus(5);

        $storageProduct1 = new ProductStorage(
            new Id(1),
            new Name('Product 1'),
            new Price(100),
            new ProductQuantity(20)
        );
        $productOrder1 = new ProductOrder(
            $storageProduct1,
            new OrderQuantity(2),
            new Price(100)
        );

        $storageProduct2 = new ProductStorage(
            new Id(2),
            new Name('Product 2'),
            new Price(100),
            new ProductQuantity(15)
        );
        $productOrder2 = new ProductOrder(
            $storageProduct2,
            new OrderQuantity(2),
            new Price(100)
        );

        $productLine = [$productOrder1, $productOrder2];

        $order = new Order($customer, $productLine);
        $order->setOrderTotal($orderTotal);
        $order->setOrderBonus($orderBonus);

        $orderTransformService = new OrderTransformService();
        $result = $orderTransformService->toArray($order);

        $expectedResult = [
            'data' => [
                'customer' => 'customer@mail.com',
                'productLine' => [
                    [
                        'id' => 1,
                        'name' => 'Product 1',
                        'price' => 100,
                        'quantity' => 2,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Product 2',
                        'price' => 100,
                        'quantity' => 2,
                    ],
                ],
                'orderTotal' => 200,
                'orderBonus' => 5,
            ],
        ];

        $this->assertEquals($expectedResult, $result);
    }
}
