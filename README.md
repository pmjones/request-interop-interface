# RequestInterop Interface Package

Interoperable interfaces for server-side request objects.

The only guarantee is property *readability*. There is no guarantee regarding property *writability*.

Consumers SHOULD treat the Request as read-only, though of course implementors MAY choose to make some or all of the properties writable or immutable.

Notes:

- Whereas `$query` is string-only, because it mimics `$_GET` which is composed only of strings, $input is scalar-only. This is because even though it nominally represents `$_POST` (which is string-only), it can also represent the parsed or decoded `php://input` stream, which may (as with `json_decode()`) result in non-string values.

- The `$method` property is not an object because it is definable as a `uppercase-string`, which means there should not need to be (e.g.) an `is($compare)` method around it to cast comparison values to uppercase; static analysis should catch such things.

Questions:

- Should _Url_ be _RequestUrl_ ?

- Should _Upload_ be _RequestUpload_ ?

