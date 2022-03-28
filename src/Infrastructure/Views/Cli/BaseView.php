<?php

declare(strict_types = 1);

namespace App\Infrastructure\Views\Cli;

use App\Infrastructure\Views\View;
use Stringable;
use function str_pad;

abstract class BaseView implements View
{
    protected function pad(string|Stringable $text = '', int $length = 15): string
    {
        return str_pad((string) $text, $length, ' ');
    }
}
