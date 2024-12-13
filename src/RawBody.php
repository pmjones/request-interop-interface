<?php
declare(strict_types=1);

namespace RequestInterop\Interface;

use Stringable;

interface RawBody extends Stringable
{
    /**
     * @var resource of type (stream)
     */
    public mixed $rawBody { get; }

    /**
     * Returns the raw body as a string.
     *
     * @see https://www.php.net/file_get_contents
     * @see https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input
     */
    public function __toString() : string;
}
