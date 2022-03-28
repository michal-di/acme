<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket\Delivery;

use App\Domain\Model\Money;

final class BasicDeliveryCost implements Delivery
{
    public function total(Money $price): Money
    {
        return match (true) {
            $price->amount() < 50 => $price->add(Money::usd(4.95)),
            $price->amount() < 90 => $price->add(Money::usd(2.95)),
            default => $price
        };
    }
}
