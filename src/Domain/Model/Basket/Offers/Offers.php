<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket\Offers;

use App\Domain\Model\Products\Products;
use Countable;
use Generator;
use IteratorAggregate;
use function array_reduce;
use function count;

final class Offers implements IteratorAggregate, Countable
{
    private readonly array $offers;

    private function __construct(Offer ...$offers)
    {
        $this->offers = $offers;
    }

    public static function new(array $offers = []): self
    {
        return new self(...$offers);
    }

    public function withOffer(Offer $offer): self
    {
        return new self($offer, ...$this->offers);
    }

    public function applyTo(Products $products): Products
    {
        return array_reduce(
            $this->offers,
            static fn(Products $products, Offer $offer): Products => $offer->applyTo($products),
            $products
        );
    }

    public function getIterator(): Generator
    {
        yield from $this->offers;
    }

    public function count(): int
    {
        return count($this->offers);
    }
}
