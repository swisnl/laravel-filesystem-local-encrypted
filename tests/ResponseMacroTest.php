<?php

namespace Swis\Filesystem\Encrypted\Tests;

use Illuminate\Support\Facades\Response;
use Swis\Filesystem\Encrypted\BinaryFileResponse;

class ResponseMacroTest extends TestCase
{
    /**
     * @test
     */
    public function it_makes_a_response()
    {
        /** @var \Swis\Filesystem\Encrypted\BinaryFileResponse $response */
        $response = Response::downloadEncrypted(__DIR__.'/_files/read/read-0.txt', 'foo-bar.txt');

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertStringContainsString('foo-bar.txt', $response->headers->get('content-disposition'));
        $this->assertStringContainsString('attachment', $response->headers->get('content-disposition'));
    }
}
