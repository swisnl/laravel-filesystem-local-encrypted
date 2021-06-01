<?php

namespace Swis\Laravel\Encrypted\Tests;

use Illuminate\Support\Facades\Storage;

class FilesystemTest extends TestCase
{
    /**
     * @test
     */
    public function itRegistersTheFilesystemDriver(): void
    {
        $contents = Storage::get('read.txt');

        $this->assertSame('YSvdOxSZ8pyTdDWeN8qI', $contents);
    }
}
