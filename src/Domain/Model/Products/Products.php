<?php

declare(strict_types = 1);

namespace App\Domain\Model\Products;

use App\Domain\Model\Money;
use Countable;
use Generator;
use IteratorAggregate;
use function array_filter;
use function array_map;
use function array_reduce;
use function count;
use const ARRAY_FILTER_USE_KEY;

final class Products implements IteratorAggregate, Countable
{
    public array $products;

    private function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    public static function new(array $products = []): self
    {
        return new self(...$products);
    }

    public function withProduct(Product $product): self
    {
        return new self($product, ...$this->products);
    }

    public function merge(self $products): self
    {
        return new self(...$this->products, ...$products->products);
    }

    public function map(callable $callback): self
    {
        return new self(...array_map($callback, $this->products));
    }

    public function filter(callable $callback): self
    {
        return new self(...array_filter($this->products, $callback));
    }

    public function odd(): self
    {
        return new self(...array_filter(
            $this->products,
            static fn(int $key): bool => !($key & 1),
            ARRAY_FILTER_USE_KEY
        ));
    }

    public function even(): self
    {
        return new self(...array_filter(
            $this->products,
            static fn(int $key): bool => (bool) ($key & 1),
            ARRAY_FILTER_USE_KEY
        ));
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function first(): Product
    {
        return $this->products[0];
    }

    public function total(): Money
    {
        return array_reduce(
            $this->products,
            static fn(Money $price, Product $product): Money => $price->add($product->price()),
            Money::usd()
        );
    }

    public function getIterator(): Generator
    {
        yield from $this->products;
    }

    public function count(): int
    {
        return count($this->products);
    }
}
