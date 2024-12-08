# RequestInterop Interface Package

This package provides interoperable interfaces for reading from copies of the PHP superglobals, in order to reduce the global mutable state problems that exist with those superglobals. It reflects and resolves the common practices of over a dozen different userland projects.

## Overview

This package provides three interfaces for a server-side _Request_, _Upload_, and _Url_.

- The _Request_ interface defines these properties and methods:

    - `CookiesArray $cookies { get; }` : a copy of the `$_COOKIES` superglobal array.

    - `mixed[] $files { get; }` : a copy of the `$_FILES` superglobal array.

    - `HeadersArray $headers { get; }` : an array of HTTP headers, typically derived from `$_SERVER`.

    - `InputArray $input { get; }` : a parsed or decoded array representation of the request body, typically a copy of the `$_POST` superglobal array.

    - `MethodString $method { get; }` : The request method, typically derived from `$_SERVER`.

    - `QueryArray $query { get; }` : an array of the request query values, typically a copy of `$_GET`.

    - `ServerArray $server` { get; } : a copy of the `$_SERVER` superglobal array.

    - `UploadsArray $uploads { get; }` : an array of _Upload_ instances, typically derived from `$_FILES`.

    - `Url $url { get; }` : a _Url_ instance.

    - `__toString() : string` : returns the contents of the request body; typically, `file_get_contents('php://input')`.

- The _Upload_ interface defines these properties and methods:

    - `?string $name { get; }` : corresponds to the `'name'` key in a `$_FILES` element.

    - `?string $fullPath { get; }` : corresponds to the `'full_path'` key in a `$_FILES` element.

    - `?string $type { get; }` : corresponds to the `'type'` key in a `$_FILES` element.

    - `?string $tmpName { get; }` : corresponds to the `'tmp_name'` key in a `$_FILES` element.

    - `?int $size { get; }` : corresponds to the `'size'` key in a `$_FILES` element.

    - `?int $error { get; }` : corresponds to the `'error'` key in a `$_FILES` element.

    - `__toString() : string` : returns the contents of the upload, typically via `file_get_contents($this->tmpName)`.

    - `move(string $to) : bool` : moves the uploaded file to another location, typically via `move_uploaded_file()`.

- The _Url_ interface defines these properties and methods:

    - `?string $scheme { get; }` : corresponds to the `host` key from `parse_url()`.

    - `?string $host { get; }` : corresponds to the `host` key from `parse_url()`.

    - `?int $port { get; }` : corresponds to the `port` key from `parse_url()`.

    - `?string $user { get; }` : corresponds to the `user` key from `parse_url()`.

    - `?string $pass { get; }` : corresponds to the `pass` key from `parse_url()`.

    - `?string $path { get; }` : corresponds to the `path` key from `parse_url()`.

    - `?string $query { get; }` : corresponds to the `query` key from `parse_url()`.

    - `?string $fragment { get; }` : corresponds to the `fragment` key from `parse_url()`.

    - `__toString() : string` : returns the full URL as a string.

This package also provides several custom types to enable better static analysis with PHPStan:

- `@phpstan-type CookiesArray array<string, string>`

- `@phpstan-type HeadersArray array<lowercase-string, string>`

- `@phpstan-type InputArray array<array-key, ?scalar|InputArray>` (to 16 levels of recursion)

- `@phpstan-type MethodString uppercase-string`

- `@phpstan-type QueryArray array<string, string|QueryArray>` (to 16 levels of recursion)

- `@phpstan-type UploadsArray array<array-key, Upload|UploadsArray>` (to 16 levels of recursion)

## Implementation Directives

Reference implementations are to be found at <https://github.com/pmjones/request-interop-impl>.

Interface properties SHOULD be implemented as read-only.

Interface property arrays SHOULD NOT allow references.

Interface properties MAY be implemented as writable or immutable.

Implementors MAY add other properties and methods to their implementations.

## Q & A

Q: What userland projects were used as reference points for RequestInterop?

A: The pre-PSR-7 versions of Aura, Cake, Code Igniter, Horde, Joomla, Klein, Lithium, MediaWiki, Nette, Phalcon, Symfony, Yaf, Yii, and Zend. See this Google Sheet for more information: https://docs.google.com/spreadsheets/d/e/2PACX-1vQzJP00bOAMYGSVQ8QIIJkXVdAg-OMEfkgna7-b2IsuoWN8x_TazxEYn-yVDF2XQIqnzmHqdDO3KEKx/pubhtml

Q: How is RequestInterop different from PSR-7?

A: The short answer is that PSR-7 attempts to model HTTP messages, whereas RequestInterop merely models the PHP superglobals. A longer answer is at [README-PSR-7.md](./README-PSR-7.md).

Q: How is RequestInterop different from the [Server-Side Request and Response Objects RFC](https://wiki.php.net/rfc/request_response)?

A: This project is an intellectual descendant of that RFC, similar in form but much reduced in scope: only the superglobal-equivalent arrays, the method string, the URL, and the uploads array properties remain. (Notably, The URL array is now a _Url_ interface.)

Q: Why properties and not methods?

A: The superglobals are presented in PHP as variables and not as functions; using properties instead of methods maintains symmetry with the language. In addition, using things like array access and null-coalesce against a property looks more typically idiomatic in PHP than with a getter method; it is the difference between `$request->query['foo'] ?? 'bar'` and `$request->getQuery()['foo'] ?? 'bar'`.

Q: Why does `$query` allow only  `string` when `$input` allows any `scalar`?

A: The `$query` property corresponds to `$_GET`, which is composed only of strings. However, `$input` corresponds to any parsed or decoded form of the request content body; different parsing strategies, such as `json_decode()`, may return various scalar types.

Q: Why is `$method` a string and not a _Method_ interface?

A: Usually the reason for a _Method_ interface is to define `is(string $method)` that will make sure the values use matching cases. However, the custom _MethodString_ type is `uppercase-string`, which means static analysis should catch mismatched casing.
