# Laravel Local Encrypted Filesystem Driver

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![Made by SWIS][ico-swis]][link-swis]

This package is a Laravel wrapper around [swisnl/flysystem-encrypted](https://github.com/swisnl/flysystem-encrypted) configured for local file storage with some added functionality.

## Install

Via Composer

``` bash
$ composer require swisnl/laravel-filesystem-local-encrypted
```

## Usage

``` php
$skeleton = new Swis\Filesystem\Encrypted();
echo $skeleton->echoPhrase('Hello, League!');
```

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

[ico-version]: https://img.shields.io/packagist/v/swisnl/laravel-filesystem-local-encrypted.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/swisnl/laravel-filesystem-local-encrypted/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/swisnl/laravel-filesystem-local-encrypted.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/swisnl/laravel-filesystem-local-encrypted.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/swisnl/laravel-filesystem-local-encrypted.svg?style=flat-square
[ico-swis]: https://img.shields.io/badge/%F0%9F%9A%80-made%20by%20SWIS-%23D9021B.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/swisnl/laravel-filesystem-local-encrypted
[link-travis]: https://travis-ci.org/swisnl/laravel-filesystem-local-encrypted
[link-scrutinizer]: https://scrutinizer-ci.com/g/swisnl/laravel-filesystem-local-encrypted/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/swisnl/laravel-filesystem-local-encrypted
[link-downloads]: https://packagist.org/packages/swisnl/laravel-filesystem-local-encrypted
[link-author]: https://github.com/swisnl
[link-contributors]: ../../contributors
[link-swis]: https://www.swis.nl
