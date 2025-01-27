# RequestInterop Interface Package

This package provides interoperable interfaces for encapsulating readable server-side request values, in order to reduce the global mutable state problems that exist with PHP superglobals. It reflects and refines the common practices of over a dozen different userland projects.

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be interpreted as described in [RFC 2119][].

## Interfaces

**The interfaces define readable properties, not getter methods.** PHP superglobals are presented as variables and not as functions; using properties instead of methods maintains symmetry with the language. In addition, using things like array access and null-coalesce against a property looks more usually idiomatic in PHP than with a getter method; it is the difference between `$request->query['foo'] ?? 'bar'` and `$request->getQuery()['foo'] ?? 'bar'` or `$request->query->get('foo', 'bar')`.

**The interfaces define property hooks for `get` but not `set`.** The interfaces guarantees only the readability; writability is outside the scope of this package.

### _Request_

The _Request_ interface represents copies of the PHP superglobals (or their equivalents) and values derived from them. It defines these properties:

- `CookiesArray $cookies { get; }` corresponds to a copy of the `$_COOKIES` superglobal array or its equivalent.

- `FilesArray $files { get; }` corresponds to a copy of the `$_FILES` superglobal array or its equivalent.

- `HeadersArray $headers { get; }` corresponds to an array of the request headers, usually derived from `$_SERVER` or its equivalent. Each array key MUST be the header field name in lower-kebab-case.

- `InputArray $input { get; }` corresponds to an array of the request body values, usually a copy of the `$_POST` superglobal array or its equivalent (such as a parsed or decoded representation of the request body).

- `MethodString $method { get; }` corresponds to the request method, usually derived from `$_SERVER` or its equivalent.

- `QueryArray $query { get; }` corresponds to an array of the request query values, usually a copy of `$_GET` or its equivalent.

- `ServerArray $server { get; }` corresponds to a copy of the `$_SERVER` superglobal array or its equivalent.

- `UploadsArray $uploads { get; }` is an array of _Upload_ instances, usually derived from `$_FILES` or its equivalent. The `$uploads` index structure MUST correspond to the structure in which the uploaded files were indexed; cf. [README-UPLOADS.md][].

- `Url $url { get; }` is a _Url_ instance corresponding to this request, usually derived from `$_SERVER` or its equivalent.

It also provides these custom PHPStan types to aid static analysis:

- `CookiesArray`: `array<string, string>`

- `FilesArray`: `mixed[]` --  Implementations MUST honor this `mixed[]` type as the recursive pseudo-type `array<array-key, FilesArrayGroup|FilesArrayItem|FilesArray>`.

- `FilesArrayGroup`:
    ```
    array{
        tmp_name:string[],
        error:int[],
        name?:string[],
        full_path?:string[],
        type?:string[],
        size?:int[],
    }
    ```

- `FilesArrayItem`:
    ```
    array{
        tmp_name:string,
        error:int,
        name?:string,
        full_path?:string,
        type?:string,
        size?:int,
    }
    ```

- `HeadersArray`: `array<lowercase-string, string>`

- `InputArray`: `mixed[]` -- Implementations MUST honor this `mixed[]` type as the recursive pseudo-type `<array-key, null|scalar|InputArray>`.

- `MethodString`: `uppercase-string`

- `ServerArray`: `array<string, string>`

- `UploadsArray`: `mixed[]` -- Implementations MUST honor this `mixed[]` type as the recursive pseudo-type `array<array-key, Upload|UploadsArray>`.

- `QueryArray`: `mixed[]` -- Implementations MUST honor this `mixed[]` type as the recursive pseudo-type `<array-key, string|QueryArray>`.

Notes:

- **The `$method` property is a string and not a _Method_ interface.** Usually the reason for a _Method_ interface is to define `is(string $method) : bool` to make sure the comparison values use matching cases. However, the custom `MethodString` type is `uppercase-string`, which means static analysis should catch mismatched casing.

- **The `FilesArray`, `InputArray`, `UploadsArray`, and `QueryArray` types are `mixed[]` only because they are recursive.** Currently, static analysis tools such as PHPStan cannot process recursive types. Implementations MUST honor these `mixed[]` types as the more strict, but not analyzable, recursive pseudo-type provided with their respective type descriptions.

- **The `QueryArray` type allows only  `string`, while `InputArray` allows any `scalar`.** The `QueryArray` values correspond to `$_GET`, which is composed only of strings. However, `InputArray` corresponds to any parsed or decoded form of the request content body; different parsing strategies, such as `json_decode()`, may return various scalar types.

- **The `ServerArray` type is `array<string, string>` and not `array<uppercase-string, string>`.** Some servers add `$_SERVER` keys in mixed case. For example, Microsoft IIS adds `IIS_WasUrlRewritten`.

### _Url_

The _Url_ interface represents the URL of the request. It defines these properties and methods:

- `?string $scheme { get; }` corresponds to the `host` key from `parse_url()`.

- `?string $host { get; }` corresponds to the `host` key from `parse_url()`.

- `?int $port { get; }` corresponds to the `port` key from `parse_url()`.

- `?string $user { get; }` corresponds to the `user` key from `parse_url()`.

- `?string $pass { get; }` corresponds to the `pass` key from `parse_url()`.

- `?string $path { get; }` corresponds to the `path` key from `parse_url()`.

- `?string $query { get; }` corresponds to the `query` key from `parse_url()`.

- `?string $fragment { get; }` corresponds to the `fragment` key from `parse_url()`.

- `__toString() : string` returns the full URL as a string.

Notes:

- **This is a _Url_ interface, not a _Uri_ interface.** This is because the protocol is intended to be included in the properties. Cf. [The Real Difference Between a URL and a URI][]: "A URL is a more specific version of a URI, so if the protocol is given or implied you should probably use URL."

### _Upload_

The _Upload_ interface represents a single uploaded file. It defines these properties and methods:

- `string $tmpName { get; }` corresponds to the `'tmp_name'` key in a `FilesArrayItem` (usually from `$_FILES`).

- `int $error { get; }` corresponds to the `'error'` key in a `FilesArrayItem` (usually from `$_FILES`).

- `?string $name { get; }` corresponds to the `'name'` key in a `FilesArrayItem` (usually from `$_FILES`).

- `?string $fullPath { get; }` corresponds to the `'full_path'` key in a `FilesArrayItem` (usually from `$_FILES`).

- `?string $type { get; }` corresponds to the `'type'` key in a `FilesArrayItem` (usually from `$_FILES`).

- `?int $size { get; }` corresponds to the `'size'` key in a `FilesArrayItem` (usually from `$_FILES`).

- `move(string $to) : bool` moves the uploaded file to another location, usually via `move_uploaded_file()`.

(Cf. <https://www.php.net/manual/en/features.file-upload.post-method.php>.)

### _Body_

The _Body_ interface represents the raw content of a _Request_ or an _Upload_. It defines these properties and methods:

- `?BodyResource $body { get; }` is a stream resource of the raw content. For a _Request_, this SHOULD refer to `php://input` but MAY refer to some other stream, whereas for an _Upload_ it SHOULD refer to the `$tmpName` property but MAY refer to some other stream.

- `__toString() : string` MUST return the entire `$body` resource as a string.

It also provides this custom PHPStan type to enable better static analysis:

- `BodyResource`: `resource` of type (stream)

Implementations of _Body_ MUST NOT be advertised as readonly or immutable. As a consequence, any implementation of _Request_ or _Upload_ that also implements _Body_ MUST NOT be advertised as readonly or immutable.

The _Body_ interface MAY be implemented independently from a _Request_ or _Upload_.

Notes:

- **The _Body_ interface is separated from the other interfaces.** Whereas readonly or immutable _Request_ and _Upload_ objects can be implemented easily, readonly and immutability on a stream resource is (practically speaking) so difficult to achieve as to be impossible. Thus, implementors who want a truly readonly or immutable _Request_ or _Upload_ can do so, though without access to the _Body_ as a resource. Implementors who need access to a _Body_ can implement it as part of a mutable _Request_ or _Upload_. Alternatively, it can be an independent mutable _Body_ alongside (but separate from) a readonly or immutable _Request_ or _Upload_.

- **The `$body` resource might be manipulated externally.** As with any stream resource, the state of the `$body` resource is mutable. Consumers might modify it, close it, leave the pointer in an unexpected location, and so on. This is why _Body_ implementations MUST NOT be advertised as readonly or immutable.

## Implementations

Implementations advertised as readonly or immutable MUST be deeply readonly or immutable; they MUST NOT encapsulate any references, resources, mutable objects, objects or arrays encapsulating references or resources or mutable objects, and so on.

Implementations MAY contain properties and methods not defined in these interfaces.

Notes:

- **Reflection does not invalidate advertisements of readonly or immutable implementations.** The ability of a consumer to use Reflection to mutate an implementation advertised as readonly or immutable does not constitute a failure to comply with RequstInterop.

- **Reference implementations** are to be found at <https://github.com/request-interop/impl>.

## Q & A

### What userland projects were used as reference points for RequestInterop?

The pre-PSR-7 versions of Aura, Cake, Code Igniter, Horde, Joomla, Klein, Lithium, MediaWiki, Nette, Phalcon, Symfony, Yaf, Yii, and Zend. See this [project comparison][] for more information.

### How is RequestInterop different from PSR-7?

The short answer is that PSR-7 attempts to model HTTP messages, whereas RequestInterop attempts to model the PHP superglobals. A longer answer is at [README-PSR-7.md][].

### How is RequestInterop different from the [Server-Side Request and Response Objects RFC](https://wiki.php.net/rfc/request_response)?

This package is an intellectual descendant of that RFC, similar in form but much reduced in scope: only the superglobal-equivalent arrays, the method string, the URL, and the uploads array properties remain. (Notably, the URL array is now a _Url_ interface.)

* * *

[RFC 2119]: https://datatracker.ietf.org/doc/html/rfc2119
[README-UPLOADS.md]: ./README-UPLOADS.md
[The Real Difference Between a URL and a URI]: https://danielmiessler.com/p/difference-between-uri-url/
[project comparison]: https://docs.google.com/spreadsheets/d/e/2PACX-1vQzJP00bOAMYGSVQ8QIIJkXVdAg-OMEfkgna7-b2IsuoWN8x_TazxEYn-yVDF2XQIqnzmHqdDO3KEKx/pubhtml
[README-PSR-7.md]: ./README-PSR-7.md
