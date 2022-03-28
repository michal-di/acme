<?php

declare(strict_types = 1);

use App\Domain\Model\Products\RegularProduct;

it('should throw an exception when product is given a negative price', function() {
    RegularProduct::new('abc', 'B01', -10);
})
    ->throws(Exception::class);
