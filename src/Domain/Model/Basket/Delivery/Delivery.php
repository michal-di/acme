<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket\Delivery;

use App\Domain\Model\Money;

interface Delivery
{
    public function total(Money $price): Money;
}
