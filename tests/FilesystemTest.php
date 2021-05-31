<?php

namespace Swis\Laravel\Encrypted\Tests;

use Illuminate\Support\Facades\Storage;

class FilesystemTest extends TestCase
{
    /**
     * @test
     */
    public function it_registers_the_filesystem_driver(): void
    {
        $contents = Storage::get('read.txt');

        $this->assertSame('YSvdOxSZ8pyTdDWeN8qI', $contents);
    }
}
