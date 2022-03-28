<?php

declare(strict_types = 1);

namespace App\Domain\Model\Products;

use App\Domain\Model\Money;

interface Discounted
{
    public function discount(): Money;

    public function product(): Product;
}
