<?php
declare(strict_types=1);

namespace RequestInterop\Interface;

/**
 * @phpstan-type CookiesArray array<string, string>
 *
 * @phpstan-type FilesArray    array<array-key, SingleFileArray|MultiFileArray>|FilesArray_00
 * @phpstan-type FilesArray_00 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_01
 * @phpstan-type FilesArray_01 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_02
 * @phpstan-type FilesArray_02 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_03
 * @phpstan-type FilesArray_03 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_04
 * @phpstan-type FilesArray_04 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_05
 * @phpstan-type FilesArray_05 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0g
 * @phpstan-type FilesArray_0g array<array-key, SingleFileArray|MultiFileArray>|FilesArray_07
 * @phpstan-type FilesArray_07 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_09
 * @phpstan-type FilesArray_09 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_09
 * @phpstan-type FilesArray_09 array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0A
 * @phpstan-type FilesArray_0A array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0B
 * @phpstan-type FilesArray_0B array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0C
 * @phpstan-type FilesArray_0C array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0D
 * @phpstan-type FilesArray_0D array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0E
 * @phpstan-type FilesArray_0E array<array-key, SingleFileArray|MultiFileArray>|FilesArray_0F
 * @phpstan-type FilesArray_0F array<array-key, SingleFileArray|MultiFileArray>|mixed[]
 *
 * @phpstan-type FilesArrayItem array{
 *     tmp_name:string,
 *     error:int,
 *     name?:string,
 *     full_path?:string,
 *     type?:string,
 *     size?:int,
 * }
 *
 * @phpstan-type FilesArrayGroup array{
 *     tmp_name:string[],
 *     error:int[],
 *     name?:string[],
 *     full_path?:string[],
 *     type?:string[],
 *     size?:int[],
 * }
 *
 * @phpstan-type HeadersArray array<lowercase-string, string>
 *
 * @phpstan-type QueryArray    array<array-key, string>|QueryArray_00
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
 * @phpstan-type QueryArray_0F array<array-key, string>|mixed[]
 *
 * @phpstan-type MethodString uppercase-string
 *
 * @phpstan-type InputArray    array<array-key, ?scalar>|InputArray_00
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
 * @phpstan-type InputArray_0F array<array-key, ?scalar>|mixed[]
 *
 * @phpstan-type ServerArray array<string, string>
 *
 * @phpstan-type UploadsArray    array<array-key, Upload>|UploadsArray_00
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
 * @phpstan-type UploadsArray_0F array<array-key, Upload>|mixed[]
 */
interface Request
{
    /** @var CookiesArray */
    public array $cookies { get; }

    /** @var FilesArray */
    public array $files { get; }

    /** @var HeadersArray */
    public array $headers { get; }

    /** @var InputArray */
    public array $input { get; }

    /** @var MethodString */
    public string $method { get; }

    /** @var QueryArray */
    public array $query { get; }

    /** @var ServerArray */
    public array $server { get; }

    /** @var UploadsArray */
    public array $uploads { get; }

    public Url $url { get; }
}
