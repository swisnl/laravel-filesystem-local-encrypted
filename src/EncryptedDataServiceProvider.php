<?php

namespace Swis\Laravel\Encrypted;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem;
use Swis\Flysystem\Encrypted\EncryptedAdapter;

class EncryptedDataServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerStorageDriver();
    }

    protected function registerStorageDriver(): void
    {
        Storage::extend(
            'local-encrypted',
            function (Application $app, array $config) {
                $permissions = $config['permissions'] ?? [];

                $links = ($config['links'] ?? null) === 'skip'
                    ? LocalAdapter::SKIP_LINKS
                    : LocalAdapter::DISALLOW_LINKS;

                return new Filesystem(
                    new EncryptedAdapter(
                        new LocalAdapter(
                            $config['root'],
                            $config['lock'] ?? LOCK_EX,
                            $links,
                            $permissions
                        ),
                        $app->make('encrypter')
                    ),
                    Arr::only($config, ['visibility', 'disable_asserts', 'url'])
                );
            }
        );
    }
}
