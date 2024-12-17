# RequestInterop Interface Package

This package provides interoperable interfaces for server-side request readability, in order to reduce the global mutable state problems that exist with PHP superglobals. It reflects and resolves the common practices of over a dozen different userland projects.

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be interpreted as described in [RFC 2119][].

## Interfaces

Implementations MAY be readonly, immutable, or mutable.

Implementations advertised as readonly or immutable MUST be deeply readonly or immutable; they MUST NOT encapsulate any references, resources, mutable objects, objects or arrays encapsulating references or resources or mutable objects, and so on.

Implementations MAY contain properties and methods not defined in these interfaces.

Notes:

- **Why does RequestInterop define readable properties instead of getter methods?** The superglobals are presented in PHP as variables and not as functions; using properties instead of methods maintains symmetry with the language. In addition, using things like array access and null-coalesce against a property looks more typically idiomatic in PHP than with a getter method; it is the difference between `$request->query['foo'] ?? 'bar'` and `$request->getQuery()['foo'] ?? 'bar'`.

- **Why does RequestInterop define property `get` but not `set`?** The intent is to guarantee only the readability of the _Request_ elements, not their writability (which is outside the scope of this package).

- **Does Reflection invalidate advertisements of readonly or immutable implementations?** No. The ability of a consumer to forcibly mutate an implementation advertised as readonly or immutable does not constitute a failure to comply with RequstInterop.

### _Request_

The _Request_ interface represents copies of the PHP superglobals (or their equivalents) and values derived from them. It defines these properties:

- `CookiesArray $cookies { get; }` corresponds to a copy of the `$_COOKIES` superglobal array or its equivalent.

- `mixed[] $files { get; }` corresponds to a copy of the `$_FILES` superglobal array or its equivalent.

- `HeadersArray $headers { get; }` corresponds to an array of request headers, typically derived from `$_SERVER` or its equivalent. Each array key MUST be the header field name in lower-kebab-case.

- `InputArray $input { get; }` corresponds to a parsed or decoded array representation of the request body, typically a copy of the `$_POST` superglobal array or its equivalent.

- `MethodString $method { get; }` corresponds to the request method, typically derived from `$_SERVER` or its equivalent.

- `QueryArray $query { get; }` corresponds to an array of the request query values, typically a copy of `$_GET` or its equivalent.

- `ServerArray $server { get; }` corresponds to a copy of the `$_SERVER` superglobal array or its equivalent.

- `UploadsArray $uploads { get; }` corresponds to an array of _Upload_ instances, typically derived from `$_FILES` or its equivalent. The `$uploads` index structure MUST correspond to the structure in which the uploaded files were indexed.  (Cf. [README-UPLOADS.md][]).

- `Url $url { get; }` is a _Url_ instance corresponding to this request, using values typically derived from `$_SERVER` or its equivalent.

It also provides several custom types to enable better static analysis with PHPStan:

- `@phpstan-type CookiesArray array<string, string>`

- `@phpstan-type HeadersArray array<lowercase-string, string>`

- `@phpstan-type InputArray array<array-key, ?scalar|InputArray>` (to 16 levels of recursion)

- `@phpstan-type MethodString uppercase-string`

- `@phpstan-type QueryArray array<string, string|QueryArray>` (to 16 levels of recursion)

- `@phpstan-type ServerArray array<string, string>`

- `@phpstan-type UploadsArray array<array-key, Upload|UploadsArray>` (to 16 levels of recursion)

Notes:

- **Why does `$query` allow only  `string` when `$input` allows any `scalar`?** The `$query` property corresponds to `$_GET`, which is composed only of strings. However, `$input` corresponds to any parsed or decoded form of the request content body; different parsing strategies, such as `json_decode()`, may return various scalar types.

- **Why is `$method` a string and not a _Method_ interface?** Usually the reason for a _Method_ interface is to define `is(string $method)` that will make sure the values use matching cases. However, the custom _MethodString_ type is `uppercase-string`, which means static analysis should catch mismatched casing.

- **Why is `ServerArray` composed of `array<string, string>` and not `array<uppercase-string, string>` ?** Some servers add `$_SERVER` keys in mixed case. For example, Microsoft IIS adds `IIS_WasUrlRewritten`.

### _Url_

The _Url_ interface represents the URL of a _Request_. It defines these properties and methods:

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

- **Why is it a _Url_ interface and not a _Uri_ interface?** Because the protocol is intended to be included in the properties. Cf. [The Real Difference Between a URL and a URI][]: "A URL is a more specific version of a URI, so if the protocol is given or implied you should probably use URL."


### _Upload_

The _Upload_ interface represents a single uploaded file. It defines these properties and methods:

- `?string $name { get; }` corresponds to the `'name'` key in a `$_FILES` element (or its equivalent).

- `?string $fullPath { get; }` corresponds to the `'full_path'` key in a `$_FILES` element (or its equivalent).

- `?string $type { get; }` corresponds to the `'type'` key in a `$_FILES` element (or its equivalent).

- `?string $tmpName { get; }` corresponds to the `'tmp_name'` key in a `$_FILES` element (or its equivalent).

- `?int $size { get; }` corresponds to the `'size'` key in a `$_FILES` element (or its equivalent).

- `?int $error { get; }` corresponds to the `'error'` key in a `$_FILES` element (or its equivalent).

- `move(string $to) : bool` moves the uploaded file to another location, typically via `move_uploaded_file()`.

### _Body_

The _Body_ interface represents the raw content of a _Request_ or an _Upload_. It defines these properties and methods:

- `?resource $body { get; }` is a stream resource of the raw content; for a _Request_, this is typically via `fopen('php://input', 'rb')`, whereas for an _Upload_ it may refer to the temporary upload location.

- `__toString() : string` MUST return the entire body as a string.

Implementations of _Body_ MUST NOT be advertised as readonly or immutable. As a consequence, any implementation of _Request_ or _Upload_ that also implements _Body_ MUST NOT be advertised as readonly or immutable.

The _Body_ interface MAY be implemented independently.

Notes:

- **Why is the _Body_ interface separated?** Whereas there is a place for readonly or immutable _Request_ and _Upload_ objects, readonly and immutability on a stream resource is (practically speaking) so difficult to achieve as to be impossible. Thus, implementors who want a truly readonly or immutable _Request_ or _Upload_ can do so, though without access to the _Body_ as a resource. Alternatively, implementors who need access to the _Body_ may implement it independently, or as part of a mutable _Request_ or _Upload_.

- **What happens if the _Body_ resource is manipulated?** As with any stream resource, the _Body_ resource is somewhat fragile. Consumers might modify it, close it, leave the pointer in an unexpected location, and so on. This means the state of the resource must usually be considered unknown, which is why _Body_ MUST NOT be advertised as readonly or immutable.


## Reference Implementations

Reference implementations MAY be found at <https://github.com/pmjones/request-interop-impl>.

## Closing Notes

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
