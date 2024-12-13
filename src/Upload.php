<?php
declare(strict_types=1);

namespace RequestInterop\Interface;

interface Upload
{
    /**
     * The original name of the file on the client machine.
     */
    public ?string $name { get; }

    /**
     * The full path as submitted by the browser. This value does not always
     * contain a real directory structure, and cannot be trusted.
     */
    public ?string $fullPath { get; }

    /**
     * The mime type of the file, if the client provided this information. This
     * mime type is however not checked on the PHP side and therefore don't
     * take its value for granted.
     */
    public ?string $type { get; }

    /**
     * The temporary filename of the file in which the uploaded file was stored
     * on the server.
     */
    public ?string $tmpName { get; }

    /**
     * The error code associated with the upload.
     */
    public ?int $error { get; }

    /**
     * The size, in bytes, of the uploaded file.
     */
    public ?int $size { get; }

    /**
     * Moves the uploaded file to a new location.
     *
     * @see https://www.php.net/move_uploaded_file
     */
    public function move(string $to) : bool;
}
