<?php

declare(strict_types = 1);

use App\Domain\Model\Basket\Basket;
use App\Domain\Model\Basket\Delivery\BasicDeliveryCost;
use App\Domain\Model\Basket\Offers\Offers;
use App\Domain\Model\Basket\Offers\SecondRedWidgetHalfPriceOffer;
use App\Domain\Model\Products\RegularProduct;
use App\Domain\Model\Products\Products;
use App\Infrastructure\Persistence\Fake\FakeProductsRepository;

it('checks if basket 1 returns proper total price using DI', function() {
    $basket = new Basket(
        new FakeProductsRepository(),
        new BasicDeliveryCost(),
        Products::new([
            RegularProduct::new('Green Widget', 'G01', 24.95),
            RegularProduct::new('Blue Widget', 'B01', 7.95),
        ]),
        Offers::new([new SecondRedWidgetHalfPriceOffer()])
    );

    expect($basket->withDiscountedProducts()->total()->amount())->toBe(37.85);
});

it('checks if basket 1 returns proper total price using add() method')
    ->expect(
        Basket::new(new FakeProductsRepository())
              ->add('G01')
              ->add('B01')
              ->withDiscountedProducts()
              ->total()
              ->amount()
    )
    ->toBe(37.85);

test('basket 2', function() {
    $basket = new Basket(
        new FakeProductsRepository(),
        new BasicDeliveryCost(),
        Products::new([
            RegularProduct::new('Red Widget', 'R01', 32.95),
            RegularProduct::new('Red Widget', 'R01', 32.95),
        ]),
        Offers::new([new SecondRedWidgetHalfPriceOffer()])
    );

    expect($basket->withDiscountedProducts()->total()->amount())->toBe(54.37);
});

it('checks if basket 2 returns proper total price using add() and withOffer() methods')
    ->expect(
        Basket::new(new FakeProductsRepository())
              ->add('R01')
              ->add('R01')
              ->withOffer(new SecondRedWidgetHalfPriceOffer())
              ->withDiscountedProducts()
              ->total()
              ->amount()
    )
    ->toBe(54.37);

test('basket 3', function() {
    $basket = new Basket(
        new FakeProductsRepository(),
        new BasicDeliveryCost(),
        Products::new([
            RegularProduct::new('Red Widget', 'R01', 32.95),
            RegularProduct::new('Green Widget', 'G01', 24.95),
        ]),
        Offers::new([new SecondRedWidgetHalfPriceOffer()])
    );

    expect($basket->withDiscountedProducts()->total()->amount())->toBe(60.85);
});

test('basket 4', function() {
    $basket = new Basket(
        new FakeProductsRepository(),
        new BasicDeliveryCost(),
        Products::new([
            RegularProduct::new('Blue Widget', 'B01', 7.95),
            RegularProduct::new('Blue Widget', 'B01', 7.95),
            RegularProduct::new('Red Widget', 'R01', 32.95),
            RegularProduct::new('Red Widget', 'R01', 32.95),
            RegularProduct::new('Red Widget', 'R01', 32.95),
        ]),
        Offers::new([new SecondRedWidgetHalfPriceOffer()])
    );

    expect($basket->withDiscountedProducts()->total()->amount())->toBe(98.27);
});
