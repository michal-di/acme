<?php

declare(strict_types = 1);

use App\Domain\Model\Basket\Offers\SecondRedWidgetHalfPriceOffer;
use App\Domain\Model\Products\Products;
use App\Domain\Model\Products\RegularProduct;

test('Second red widget should be half price')
    ->expect(function() {
        $products = Products::new([
            RegularProduct::new('Red Widget', 'R01', 100),
            RegularProduct::new('Red Widget', 'R01', 100),
            RegularProduct::new('Green Widget', 'G01', 100),
            RegularProduct::new('Red Widget', 'R01', 100),
        ]);

        return (new SecondRedWidgetHalfPriceOffer())
            ->applyTo($products)
            ->total()
            ->amount();
    })
    ->toBe(350.0);
