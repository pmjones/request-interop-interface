<?php
declare(strict_types=1);

namespace RequestInterop\Interface;

use Stringable;

/**
 * @phpstan-type BodyResource resource of type (stream)
 */
interface Body extends Stringable
{
    /**
     * @var BodyResource
     */
    public mixed $body { get; }

    /**
     * @see https://www.php.net/stream_get_contents
     * @see https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input
     */
    public function __toString() : string;
}
