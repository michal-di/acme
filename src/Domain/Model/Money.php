<?php

declare(strict_types = 1);

namespace App\Domain\Model;

use InvalidArgumentException;
use function number_format;
use function round;
use const PHP_ROUND_HALF_DOWN;

final class Money implements \Stringable
{
    private const USD = 'USD';

    private readonly int    $amount;
    private readonly string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    public static function usd(float $amount = 0): self
    {
        return new self((int) ($amount * 100), self::USD);
    }

    public function add(self $money): self
    {
        $this->isCorrectCurrency($money);

        return new self($this->amount + $money->amount, $this->currency);
    }

    public function subtract(self $money): self
    {
        $this->isCorrectCurrency($money);

        return new self($this->amount - $money->amount, $this->currency);
    }

    public function half(): self
    {
        return new self((int) ($this->amount / 2), $this->currency);
    }

    public function amount(): float
    {
        return $this->amount / 100;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function __toString(): string
    {
        return number_format(round($this->amount(), 2, PHP_ROUND_HALF_DOWN), 2);
    }

    private function isCorrectCurrency(Money $money): void
    {
        if ($this->currency !== $money->currency) {
            throw new InvalidArgumentException(
                "Provided currency ($money->currency) does not match $this->currency"
            );
        }
    }
}
