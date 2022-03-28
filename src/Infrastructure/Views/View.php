<?php

declare(strict_types = 1);

namespace App\Infrastructure\Views;

interface View extends \Stringable
{
    public function __toString(): string;
}
