<?php

declare(strict_types = 1);

use App\Domain\Model\Products\Products;
use App\Domain\Model\Products\RegularProduct;

beforeEach(fn() => $this->products = Products::new([
    RegularProduct::new('Red Widget', 'R01', 32.95),
    RegularProduct::new('Red Widget', 'R01', 32.95),
]));

it('adds new product to the collection')
    ->expect(fn() => $this->products->withProduct(
        RegularProduct::new('Red Widget 1', 'R01', 32.95)
    ))
    ->toHaveCount(3);

it('checks if collection is empty')
    ->expect(Products::new())
    ->toHaveCount(0);

it('checks if collection is empty by using isEmpty() method')
    ->expect(Products::new()->isEmpty())
    ->toBeTrue();

it('checks if non-empty collection is empty by using isEmpty() method')
    ->expect(fn() => $this->products->isEmpty())
    ->toBeFalse();
