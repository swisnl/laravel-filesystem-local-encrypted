<?php

declare(strict_types=1);

namespace Swis\Laravel\Encrypted\Tests;

use Swis\Laravel\Encrypted\File;

class FileTest extends TestCase
{
    /**
     * @test
     * @dataProvider getMimetypeData
     *
     * @param string $path
     * @param string $expectedMimetype
     */
    public function it_can_get_the_mime_type(string $path, string $expectedMimetype)
    {
        // arrange
        $file = new File(__DIR__.'/_files/mime/'.$path);

        // act
        $mimetype = $file->getMimeType();

        // assert
        $this->assertSame($expectedMimetype, $mimetype);
    }

    public function getMimetypeData(): array
    {
        return [
            ['mime-0.pdf', 'application/pdf'],
            ['mime-1.txt', 'text/plain'],
            ['mime-2.jpeg', 'image/jpeg'],
            ['mime-3.doc', 'application/msword'],
        ];
    }

    /**
     * @test
     * @dataProvider getSizeData
     *
     * @param string $path
     * @param int    $expectedSize
     */
    public function it_can_get_the_size(string $path, int $expectedSize)
    {
        // arrange
        $file = new File(__DIR__.'/_files/size/'.$path);

        // act
        $size = $file->getSize();

        // assert
        $this->assertSame($expectedSize, $size);
    }

    public function getSizeData(): array
    {
        return [
            ['size-0.txt', 50],
            ['size-1.txt', 100],
            ['size-2.txt', 123],
            ['size-3.txt', 456],
            ['size-4.txt', 200],
            ['size-5.txt', 10],
            ['size-6.txt', 250],
            ['size-7.txt', 300],
            ['size-8.txt', 333],
            ['size-9.txt', 500],
        ];
    }
}
