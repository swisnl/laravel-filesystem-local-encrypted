# Laravel Utilities for Encrypted Data

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![Made by SWIS][ico-swis]][link-swis]

This package contains several Laravel utilities to work with encrypted data.

## Install

Via Composer

``` bash
$ composer require swisnl/laravel-encrypted-data
```

## Usage

### Filesystem

Configure the storage driver in `config/filesystems.php`

``` php
'disks' => [
    'local' => [
        'driver' => 'local-encrypted',
        'root' => storage_path('app'),
    ],
],
```

You can now simply use the storage methods as usual and everything will be encrypted/decrypted under the hood!

#### Download encrypted file

This package also includes a response macro so you can easily start a file download of an encrypted file as an alternative to `Storage::download('file.jpg')`.

``` php
Response::downloadEncrypted('/path/to/encrypted-file', 'foo-bar.txt');
// or
response()->downloadEncrypted('/path/to/encrypted-file', 'foo-bar.txt');
```

## Known limitations

Due to the encryption, some limitations apply:

1. You can't use the public disk as that will download the raw encrypted files, so using `Storage::url()` and `Storage::temporaryUrl()` does not make sense;
2. You can use streams with this disk, but internally we will always convert those to strings because the entire file contents need to be encrypted/decrypted at once.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email security@swis.nl instead of using the issue tracker.

## Credits

- [Jasper Zonneveld][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## SWIS :heart: Open Source

[SWIS][link-swis] is a web agency from Leiden, the Netherlands. We love working with open source software. 

[ico-version]: https://img.shields.io/packagist/v/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/swisnl/laravel-encrypted-data/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-swis]: https://img.shields.io/badge/%F0%9F%9A%80-made%20by%20SWIS-%23D9021B.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/swisnl/laravel-encrypted-data
[link-travis]: https://travis-ci.org/swisnl/laravel-encrypted-data
[link-scrutinizer]: https://scrutinizer-ci.com/g/swisnl/laravel-encrypted-data/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/swisnl/laravel-encrypted-data
[link-downloads]: https://packagist.org/packages/swisnl/laravel-encrypted-data
[link-author]: https://github.com/swisnl
[link-contributors]: ../../contributors
[link-swis]: https://www.swis.nl
