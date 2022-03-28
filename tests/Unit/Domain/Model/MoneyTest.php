<?php

declare(strict_types = 1);

use App\Domain\Model\Money;

beforeEach(fn() => $this->money = Money::usd(15));

it('creates new money object for USD')
    ->expect(fn() => $this->money->amount())
    ->toBe(15.0);

it('has __toString() support')
    ->expect(fn() => (string) $this->money)
    ->toBe('15.00');

it('has proper currency')
    ->expect(fn() => $this->money->currency())
    ->toBe('USD');

it('divides money in half')
    ->expect(fn() => $this->money->half()->amount())
    ->toBe(7.5);

it('sums two values')
    ->expect(Money::usd(10)->add(Money::usd(15))->amount())
    ->toBe(25.0);

it('must have the same currencies in summing two values', function() {
    Money::usd(10)->add(new Money(15, 'GBP'));
})
    ->throws(InvalidArgumentException::class);
