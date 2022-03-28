<?php

declare(strict_types = 1);

use App\Domain\Model\Money;
use App\Domain\Model\Products\DiscountedProduct;
use App\Domain\Model\Products\RegularProduct;
use App\Infrastructure\Views\Cli\CliDiscountedProductView;

it('should render proper row for discounted product')
    ->expect((string) new CliDiscountedProductView(new DiscountedProduct(
        RegularProduct::new('widget', 'R01', 100),
        Money::usd(75)
    )))
    ->toBe('widget          $75.00      $25.00     ');
