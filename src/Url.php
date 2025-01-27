<?php
declare(strict_types=1);

namespace RequestInterop\Interface;

use Stringable;

interface Url extends Stringable
{
    public ?string $scheme { get; }

    public ?string $host { get; }

    public ?int $port { get; }

    public ?string $user { get; }

    public ?string $pass { get; }

    public ?string $path { get; }

    public ?string $query { get; }

    public ?string $fragment { get; }

    public function __toString() : string;
}
