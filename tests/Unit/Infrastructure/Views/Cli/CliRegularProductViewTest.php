<?php

declare(strict_types = 1);

use App\Domain\Model\Products\RegularProduct;
use App\Infrastructure\Views\Cli\CliRegularProductView;

it('should render proper row for discounted product')
    ->expect((string) new CliRegularProductView(
        RegularProduct::new('widget', 'R01', 100)
    ))
    ->toBe('widget          $100.00    ');
