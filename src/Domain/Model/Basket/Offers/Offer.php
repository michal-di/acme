<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket\Offers;

use App\Domain\Model\Products\Products;

interface Offer
{
    public function applyTo(Products $products): Products;
}
