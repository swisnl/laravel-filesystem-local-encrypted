<?php

namespace Swis\Filesystem\Encrypted;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem;
use Swis\Flysystem\Encrypted\EncryptedAdapter;

class LocalEncryptedFilesystemServiceProvider extends ServiceProvider
{
    /**
     * @throws \LogicException
     */
    public function boot()
    {
        $this->registerStorageDriver();
        $this->registerResponseMacro();
    }

    protected function registerStorageDriver()
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

    protected function registerResponseMacro()
    {
        Response::macro(
            'downloadEncrypted',
            /**
             * @param \SplFileInfo|string $file
             * @param null $name
             * @param array $headers
             * @param string $disposition
             *
             * @return \Swis\Filesystem\Encrypted\BinaryFileResponse
             */
            function ($file, $name = null, array $headers = [], $disposition = 'attachment') {
                $response = new BinaryFileResponse($file, 200, $headers, false, $disposition);

                if (null !== $name) {
                    return $response->setContentDisposition(
                        $disposition,
                        $name,
                        str_replace('%', '', Str::ascii($name))
                    );
                }

                return $response;
            }
        );
    }
}
