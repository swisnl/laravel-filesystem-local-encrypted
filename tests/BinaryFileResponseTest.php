<?php

declare(strict_types=1);

namespace Swis\Laravel\Encrypted\Tests;

use SplFileInfo;
use Swis\Laravel\Encrypted\BinaryFileResponse;
use Swis\Laravel\Encrypted\File;

class BinaryFileResponseTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_the_file_to_an_encrypted_file_instance_if_it_is_a_string()
    {
        // arrange
        $file = __DIR__.'/_files/read/read-0.txt';

        // act
        $response = new BinaryFileResponse($file);

        // assert
        $this->assertInstanceOf(File::class, $response->getFile());
    }

    /**
     * @test
     */
    public function it_sets_the_file_to_an_encrypted_file_instance_if_it_is_a_spl_file_info()
    {
        // arrange
        $file = new SplFileInfo(__DIR__.'/_files/read/read-0.txt');

        // act
        $response = new BinaryFileResponse($file);

        // assert
        $this->assertInstanceOf(File::class, $response->getFile());
    }

    /**
     * @test
     */
    public function it_sends_decrypted_file_contents()
    {
        // arrange
        $file = __DIR__.'/_files/read/read-0.txt';
        $response = new BinaryFileResponse($file);

        // assert
        $this->expectOutputString('YSvdOxSZ8pyTdDWeN8qI');

        // act
        $response->sendContent();
    }

    /**
     * @test
     */
    public function it_deletes_the_file_after_sending_the_contents()
    {
        // arrange
        $file = __DIR__.'/_files/read/read-temp.txt';
        copy(__DIR__.'/_files/read/read-0.txt', $file);
        $response = new BinaryFileResponse($file);
        $response->deleteFileAfterSend(true);

        // Set expected output to prevent actual output
        $this->expectOutputRegex('/.+/');

        // act
        $response->sendContent();

        // assert
        if (method_exists($this, 'assertFileDoesNotExist')) {
            $this->assertFileDoesNotExist($file);
        } else {
            $this->assertFileNotExists($file);
        }
    }
}
