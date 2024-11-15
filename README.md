# Laravel Utilities for Encrypted Data

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Buy us a tree][ico-treeware]][link-treeware]
[![Build Status][ico-github-actions]][link-github-actions]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![Made by SWIS][ico-swis]][link-swis]

This package contains several Laravel utilities to work with encrypted data.

## Install

Via Composer

```bash
composer require swisnl/laravel-encrypted-data
```

N.B. Using Laravel 6-8? Please use version [1.x](https://github.com/swisnl/laravel-encrypted-data/tree/1.x) of this package.

## Usage

### Models

> [!WARNING]
> Laravel supports [encrypted casts](https://laravel.com/docs/10.x/eloquent-mutators#encrypted-casting) since version 8.12, so new projects should use that instead of the models provided by this package.
>
> Please see [MIGRATING](MIGRATING.md) for a step-by-step guide on how to migrate.
>

Extend `\Swis\Laravel\Encrypted\EncryptedModel` in your model and define the encrypted fields. Make sure your database columns are long enough, so your data isn't truncated!

```php
protected $encrypted = [
    'secret',
];
```

You can now simply use the model properties as usual and everything will be encrypted/decrypted under the hood!

### Filesystem

Configure the storage driver in `config/filesystems.php`.

```php
'disks' => [
    'local' => [
        'driver' => 'local-encrypted',
        'root' => storage_path('app'),
    ],
],
```

You can now simply use the storage methods as usual and everything will be encrypted/decrypted under the hood!

## Known issues/limitations

Due to the encryption, some issues/limitations apply:

1. Encrypted data is — depending on what you encrypt — roughly 30-40% bigger.

### Models

1. You can't query or order columns that are encrypted in your SQL-statements, but you can query or sort the results using collection methods;
2. All data is being serialized before it is encrypted — and unserialized after it is decrypted — so everything is stored exactly as how Laravel would insert it into the database. You can use [Eloquent Mutators](https://laravel.com/docs/9.x/eloquent-mutators) as you normally would.

### Filesystem

1. You can't use the public disk as that will download the raw encrypted files, so using `Storage::url()` and `Storage::temporaryUrl()` does not make sense;
2. You can use streams with this disk, but internally we will always convert those to strings because the entire file contents need to be encrypted/decrypted at once.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
composer test
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

This package is [Treeware](https://treeware.earth). If you use it in production, then we ask that you [**buy the world a tree**][link-treeware] to thank us for our work. By contributing to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

## SWIS :heart: Open Source

[SWIS][link-swis] is a web agency from Leiden, the Netherlands. We love working with open source software. 

[ico-version]: https://img.shields.io/packagist/v/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-treeware]: https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen.svg?style=flat-square
[ico-github-actions]: https://img.shields.io/github/actions/workflow/status/swisnl/laravel-encrypted-data/tests.yml?label=tests&branch=master&style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/swisnl/laravel-encrypted-data.svg?style=flat-square
[ico-swis]: https://img.shields.io/badge/%F0%9F%9A%80-made%20by%20SWIS-%230737A9.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/swisnl/laravel-encrypted-data
[link-github-actions]: https://github.com/swisnl/laravel-encrypted-data/actions/workflows/tests.yml
[link-scrutinizer]: https://scrutinizer-ci.com/g/swisnl/laravel-encrypted-data/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/swisnl/laravel-encrypted-data
[link-downloads]: https://packagist.org/packages/swisnl/laravel-encrypted-data
[link-treeware]: https://plant.treeware.earth/swisnl/laravel-encrypted-data
[link-author]: https://github.com/swisnl
[link-contributors]: ../../contributors
[link-swis]: https://www.swis.nl
