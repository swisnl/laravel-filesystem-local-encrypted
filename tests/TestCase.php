<?php

namespace Swis\Laravel\Encrypted\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Swis\Laravel\Encrypted\LocalEncryptedFilesystemServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [LocalEncryptedFilesystemServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'JwedQwbFHOZamnyxwih0Pjc029U2KQpp');
        $app['config']->set('filesystems.default', 'local');
        $app['config']->set('filesystems.disks.local', ['driver' => 'local-encrypted', 'root' => __DIR__.'/_files/']);
    }
}
