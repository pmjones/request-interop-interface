<?php
declare(strict_types=1);

namespace RequestInterop\Interface;

use Stringable;

/**
 * @phpstan-type CookiesArray array<string, string>
 *
 * @phpstan-type HeadersArray array<lowercase-string, string>
 *
 * @phpstan-type InputArray array<array-key, ?scalar>
 *     |InputArray_00
 *     |InputArray_01
 *     |InputArray_02
 *     |InputArray_03
 *     |InputArray_04
 *     |InputArray_05
 *     |InputArray_06
 *     |InputArray_07
 *     |InputArray_08
 *     |InputArray_09
 *     |InputArray_0A
 *     |InputArray_0B
 *     |InputArray_0C
 *     |InputArray_0D
 *     |InputArray_0E
 *     |InputArray_0F
 *     |InputArray_10
 *     |InputArray_11
 *     |InputArray_12
 *     |InputArray_13
 *     |InputArray_14
 *     |InputArray_15
 *     |InputArray_16
 *     |InputArray_17
 *     |InputArray_18
 *     |InputArray_19
 *     |InputArray_1A
 *     |InputArray_1B
 *     |InputArray_1C
 *     |InputArray_1D
 *     |InputArray_1E
 *     |InputArray_1F
 *
 * @phpstan-type InputArray_00 array<array-key, ?scalar>|InputArray_01
 * @phpstan-type InputArray_01 array<array-key, ?scalar>|InputArray_02
 * @phpstan-type InputArray_02 array<array-key, ?scalar>|InputArray_03
 * @phpstan-type InputArray_03 array<array-key, ?scalar>|InputArray_04
 * @phpstan-type InputArray_04 array<array-key, ?scalar>|InputArray_05
 * @phpstan-type InputArray_05 array<array-key, ?scalar>|InputArray_06
 * @phpstan-type InputArray_06 array<array-key, ?scalar>|InputArray_07
 * @phpstan-type InputArray_07 array<array-key, ?scalar>|InputArray_08
 * @phpstan-type InputArray_08 array<array-key, ?scalar>|InputArray_09
 * @phpstan-type InputArray_09 array<array-key, ?scalar>|InputArray_0A
 * @phpstan-type InputArray_0A array<array-key, ?scalar>|InputArray_0B
 * @phpstan-type InputArray_0B array<array-key, ?scalar>|InputArray_0C
 * @phpstan-type InputArray_0C array<array-key, ?scalar>|InputArray_0D
 * @phpstan-type InputArray_0D array<array-key, ?scalar>|InputArray_0E
 * @phpstan-type InputArray_0E array<array-key, ?scalar>|InputArray_0F
 * @phpstan-type InputArray_0F array<array-key, ?scalar>|InputArray_10
 * @phpstan-type InputArray_10 array<array-key, ?scalar>|InputArray_11
 * @phpstan-type InputArray_11 array<array-key, ?scalar>|InputArray_12
 * @phpstan-type InputArray_12 array<array-key, ?scalar>|InputArray_13
 * @phpstan-type InputArray_13 array<array-key, ?scalar>|InputArray_14
 * @phpstan-type InputArray_14 array<array-key, ?scalar>|InputArray_15
 * @phpstan-type InputArray_15 array<array-key, ?scalar>|InputArray_16
 * @phpstan-type InputArray_16 array<array-key, ?scalar>|InputArray_17
 * @phpstan-type InputArray_17 array<array-key, ?scalar>|InputArray_18
 * @phpstan-type InputArray_18 array<array-key, ?scalar>|InputArray_19
 * @phpstan-type InputArray_19 array<array-key, ?scalar>|InputArray_1A
 * @phpstan-type InputArray_1A array<array-key, ?scalar>|InputArray_1B
 * @phpstan-type InputArray_1B array<array-key, ?scalar>|InputArray_1C
 * @phpstan-type InputArray_1C array<array-key, ?scalar>|InputArray_1D
 * @phpstan-type InputArray_1D array<array-key, ?scalar>|InputArray_1E
 * @phpstan-type InputArray_1E array<array-key, ?scalar>|InputArray_1F
 * @phpstan-type InputArray_1F array<array-key, ?scalar>|mixed[]
 *
 * @phpstan-type MethodString uppercase-string
 *
 * @phpstan-type QueryArray array<array-key, string>
 *     |QueryArray_00
 *     |QueryArray_01
 *     |QueryArray_02
 *     |QueryArray_03
 *     |QueryArray_04
 *     |QueryArray_05
 *     |QueryArray_06
 *     |QueryArray_07
 *     |QueryArray_08
 *     |QueryArray_09
 *     |QueryArray_0A
 *     |QueryArray_0B
 *     |QueryArray_0C
 *     |QueryArray_0D
 *     |QueryArray_0E
 *     |QueryArray_0F
 *     |QueryArray_10
 *     |QueryArray_11
 *     |QueryArray_12
 *     |QueryArray_13
 *     |QueryArray_14
 *     |QueryArray_15
 *     |QueryArray_16
 *     |QueryArray_17
 *     |QueryArray_18
 *     |QueryArray_19
 *     |QueryArray_1A
 *     |QueryArray_1B
 *     |QueryArray_1C
 *     |QueryArray_1D
 *     |QueryArray_1E
 *     |QueryArray_1F
 *
 * @phpstan-type QueryArray_00 array<array-key, string>|QueryArray_01
 * @phpstan-type QueryArray_01 array<array-key, string>|QueryArray_02
 * @phpstan-type QueryArray_02 array<array-key, string>|QueryArray_03
 * @phpstan-type QueryArray_03 array<array-key, string>|QueryArray_04
 * @phpstan-type QueryArray_04 array<array-key, string>|QueryArray_05
 * @phpstan-type QueryArray_05 array<array-key, string>|QueryArray_06
 * @phpstan-type QueryArray_06 array<array-key, string>|QueryArray_07
 * @phpstan-type QueryArray_07 array<array-key, string>|QueryArray_08
 * @phpstan-type QueryArray_08 array<array-key, string>|QueryArray_09
 * @phpstan-type QueryArray_09 array<array-key, string>|QueryArray_0A
 * @phpstan-type QueryArray_0A array<array-key, string>|QueryArray_0B
 * @phpstan-type QueryArray_0B array<array-key, string>|QueryArray_0C
 * @phpstan-type QueryArray_0C array<array-key, string>|QueryArray_0D
 * @phpstan-type QueryArray_0D array<array-key, string>|QueryArray_0E
 * @phpstan-type QueryArray_0E array<array-key, string>|QueryArray_0F
 * @phpstan-type QueryArray_0F array<array-key, string>|QueryArray_10
 * @phpstan-type QueryArray_10 array<array-key, string>|QueryArray_11
 * @phpstan-type QueryArray_11 array<array-key, string>|QueryArray_12
 * @phpstan-type QueryArray_12 array<array-key, string>|QueryArray_13
 * @phpstan-type QueryArray_13 array<array-key, string>|QueryArray_14
 * @phpstan-type QueryArray_14 array<array-key, string>|QueryArray_15
 * @phpstan-type QueryArray_15 array<array-key, string>|QueryArray_16
 * @phpstan-type QueryArray_16 array<array-key, string>|QueryArray_17
 * @phpstan-type QueryArray_17 array<array-key, string>|QueryArray_18
 * @phpstan-type QueryArray_18 array<array-key, string>|QueryArray_19
 * @phpstan-type QueryArray_19 array<array-key, string>|QueryArray_1A
 * @phpstan-type QueryArray_1A array<array-key, string>|QueryArray_1B
 * @phpstan-type QueryArray_1B array<array-key, string>|QueryArray_1C
 * @phpstan-type QueryArray_1C array<array-key, string>|QueryArray_1D
 * @phpstan-type QueryArray_1D array<array-key, string>|QueryArray_1E
 * @phpstan-type QueryArray_1E array<array-key, string>|QueryArray_1F
 * @phpstan-type QueryArray_1F array<array-key, string>|mixed[]
 *
 * @phpstan-type ServerArray array<uppercase-string, string>
 *
 * @phpstan-type UploadsArray array<array-key, Upload>
 *     |UploadsArray_00
 *     |UploadsArray_01
 *     |UploadsArray_02
 *     |UploadsArray_03
 *     |UploadsArray_04
 *     |UploadsArray_05
 *     |UploadsArray_06
 *     |UploadsArray_07
 *     |UploadsArray_08
 *     |UploadsArray_09
 *     |UploadsArray_0A
 *     |UploadsArray_0B
 *     |UploadsArray_0C
 *     |UploadsArray_0D
 *     |UploadsArray_0E
 *     |UploadsArray_0F
 *     |UploadsArray_10
 *     |UploadsArray_11
 *     |UploadsArray_12
 *     |UploadsArray_13
 *     |UploadsArray_14
 *     |UploadsArray_15
 *     |UploadsArray_16
 *     |UploadsArray_17
 *     |UploadsArray_18
 *     |UploadsArray_19
 *     |UploadsArray_1A
 *     |UploadsArray_1B
 *     |UploadsArray_1C
 *     |UploadsArray_1D
 *     |UploadsArray_1E
 *     |UploadsArray_1F
 *
 * @phpstan-type UploadsArray_00 array<array-key, Upload>|UploadsArray_01
 * @phpstan-type UploadsArray_01 array<array-key, Upload>|UploadsArray_02
 * @phpstan-type UploadsArray_02 array<array-key, Upload>|UploadsArray_03
 * @phpstan-type UploadsArray_03 array<array-key, Upload>|UploadsArray_04
 * @phpstan-type UploadsArray_04 array<array-key, Upload>|UploadsArray_05
 * @phpstan-type UploadsArray_05 array<array-key, Upload>|UploadsArray_06
 * @phpstan-type UploadsArray_06 array<array-key, Upload>|UploadsArray_07
 * @phpstan-type UploadsArray_07 array<array-key, Upload>|UploadsArray_08
 * @phpstan-type UploadsArray_08 array<array-key, Upload>|UploadsArray_09
 * @phpstan-type UploadsArray_09 array<array-key, Upload>|UploadsArray_0A
 * @phpstan-type UploadsArray_0A array<array-key, Upload>|UploadsArray_0B
 * @phpstan-type UploadsArray_0B array<array-key, Upload>|UploadsArray_0C
 * @phpstan-type UploadsArray_0C array<array-key, Upload>|UploadsArray_0D
 * @phpstan-type UploadsArray_0D array<array-key, Upload>|UploadsArray_0E
 * @phpstan-type UploadsArray_0E array<array-key, Upload>|UploadsArray_0F
 * @phpstan-type UploadsArray_0F array<array-key, Upload>|UploadsArray_10
 * @phpstan-type UploadsArray_10 array<array-key, Upload>|UploadsArray_11
 * @phpstan-type UploadsArray_11 array<array-key, Upload>|UploadsArray_12
 * @phpstan-type UploadsArray_12 array<array-key, Upload>|UploadsArray_13
 * @phpstan-type UploadsArray_13 array<array-key, Upload>|UploadsArray_14
 * @phpstan-type UploadsArray_14 array<array-key, Upload>|UploadsArray_15
 * @phpstan-type UploadsArray_15 array<array-key, Upload>|UploadsArray_16
 * @phpstan-type UploadsArray_16 array<array-key, Upload>|UploadsArray_17
 * @phpstan-type UploadsArray_17 array<array-key, Upload>|UploadsArray_18
 * @phpstan-type UploadsArray_18 array<array-key, Upload>|UploadsArray_19
 * @phpstan-type UploadsArray_19 array<array-key, Upload>|UploadsArray_1A
 * @phpstan-type UploadsArray_1A array<array-key, Upload>|UploadsArray_1B
 * @phpstan-type UploadsArray_1B array<array-key, Upload>|UploadsArray_1C
 * @phpstan-type UploadsArray_1C array<array-key, Upload>|UploadsArray_1D
 * @phpstan-type UploadsArray_1D array<array-key, Upload>|UploadsArray_1E
 * @phpstan-type UploadsArray_1E array<array-key, Upload>|UploadsArray_1F
 * @phpstan-type UploadsArray_1F array<array-key, Upload>|mixed[]
 */
interface Request extends Stringable
{
    /**
     * A copy of `$_COOKIES`.
     *
     * @var CookiesArray
     */
    public array $cookies { get; }

    /**
     * A copy of `$_FILES`.
     *
     * @var mixed[]
     */
    public array $files { get; }

    /**
     * An array of key/value pairs computed from `$_SERVER` using all `HTTP_*`
     * header keys, plus RFC 3875 headers not prefixed with `HTTP_`.
     *
     * @var HeadersArray
     */
    public array $headers { get; }

    /**
     * A copy of `$_POST`, or a parsed representation of the request body
     * (i.e. the `php://input` stream).
     *
     * @var InputArray
     */
    public array $input { get; }

    /**
     * The HTTP request method.
     *
     * @var MethodString
     */
    public string $method { get; }

    /**
     * A copy of `$_GET`.
     *
     * @var QueryArray
     */
    public array $query { get; }

    /**
     * A copy of `$_SERVER`.
     *
     * @var ServerArray
     */
    public array $server { get; }

    /**
     * A copy of `$_FILES`, restructured to look more like `$_POST`.
     *
     * @var UploadsArray
     */
    public array $uploads { get; }

    public Url $url { get; }

    /**
     * Returns the raw request body as a string.
     *
     * @see https://www.php.net/file_get_contents
     * @see https://www.php.net/manual/en/wrappers.php.php#wrappers.php.input
     */
    public function __toString() : string;
}
