<?php

declare(strict_types = 1);

use App\Domain\Model\Basket\Delivery\BasicDeliveryCost;
use App\Domain\Model\Products\RegularProduct;

it('returns product and delivery cost for product under $50')
    ->expect((new BasicDeliveryCost())->total(
        RegularProduct::new('Widget', 'ABC', 7.95)->price()
    )->amount())
    ->toBe(12.9);

it('returns product and delivery cost for product under $90')
    ->expect((new BasicDeliveryCost())->total(
        RegularProduct::new('Widget', 'ABC', 51)->price()
    )->amount())
    ->toBe(53.95);

it('returns product and free delivery cost for product above $90')
    ->expect((new BasicDeliveryCost())->total(
        RegularProduct::new('Widget', 'ABC', 95)->price()
    )->amount())
    ->toBe(95.0);
