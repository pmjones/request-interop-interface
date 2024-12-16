# The _Request_ `$uploads` Property

The _Request_ `$files` property is typically an identical copy of `$_FILES`. Normally, `$_FILES` looks like this with multi-file uploads:

```php
assert($_FILES === [
    'images' => [
        'name' => [
            0 => 'image1.png',
            1 => 'image2.gif',
            2 => 'image3.jpg',
        ],
        'type' => [
            0 => 'image/png',
            1 => 'image/gif',
            2 => 'image/jpeg',
        ],
        'tmp_name' [
            0 => '/tmp/path/phpABCDEF',
            1 => '/tmp/path/phpGHIJKL',
            2 => '/tmp/path/phpMNOPQR',
        ],
        'error' => [
            0 => 0,
            1 => 0,
            2 => 0,
        ],
        'size' =>[
            0 => 123456,
            1 => 234567,
            2 => 345678,
        ],
    ],
]);
```

However, that structure is not at all what we expect when we compare it to `$_POST`.

Therefore, the _Request_ `$uploads` property retains the data in `$_FILES` in a structure that looks like `$_POST` ...

```php
// restructured:
[
    'images' => [
        0 => [
            'name' => 'image1.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/path/phpABCDEF',
            'error' => 0,
            'size' => 123456,
        ],
        1 => [
            'name' => 'image2.gif',
            'type' => 'image/gif',
            'tmp_name' => '/tmp/path/phpGHIJKL',
            'error' => 0,
            'size' => 234567,
        ],
        2 => [
            'name' => 'image3.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => '/tmp/path/phpMNOPQR',
            'error' => 0,
            'size' => 345678,
        ],
    ],
];
```

... where each array-based descriptor is replaced with an _Upload_ instance.

Cf. the reference implementation at [https://github.com/pmjones/request-interop-impl/src/RequestFactory.php][].
