# Migrating swisnl/laravel-encrypted-data

## To Laravel Encrypted Casting
The main difference between this package and [Laravel Encrypted Casting](https://laravel.com/docs/10.x/eloquent-mutators#encrypted-casting) is that this package serializes the data before encrypting it, while Laravel Encrypted Casting encrypts the data directly. This means that the data is not compatible between the two packages. In order to migrate from this package to Laravel Encrypted Casting, you will need to decrypt the data and then re-encrypt it using Laravel Encrypted Casting. Here is a step-by-step guide on how to do this:

[//]: # (TODO: What to do when you need serialized data or encrypted dates?)

1. Set up Encrypted Casting, but keep extending `EncryptedModel` from this package:
```diff
- protected $encrypted = [
-     'secret',
- ];
+ protected $casts = [
+     'secret' => 'encrypted',
+ ];
```
2. Set up our custom model encrypter in your `AppServiceProvider`:
```php
public function boot(): void
{
    $modelEncrypter = new \Swis\Laravel\Encrypted\ModelEncrypter();
    YourEncryptedModel::encryptUsing($modelEncrypter);
    // ... all your other models that extend \Swis\Laravel\Encrypted\EncryptedModel
}
```
3. Run our re-encryption command:
```bash
php artisan encrypted-data:re-encrypt:models --quietly --no-touch
```
N.B. Use `--help` to see all available options and modify as needed!
4. Remove the `Swis\Laravel\Encrypted\EncryptedModel` from your models and replace it with `Illuminate\Database\Eloquent\Model`:
```diff
- use Swis\Laravel\Encrypted\EncryptedModel
+ use Illuminate\Database\Eloquent\Model

- class YourEncryptedModel extends EncryptedModel
+ class YourEncryptedModel extends Model
```
5. Remove our custom model encrypter from your `AppServiceProvider` (step 2).
