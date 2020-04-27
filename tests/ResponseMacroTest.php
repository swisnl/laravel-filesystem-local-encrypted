<?php

namespace Swis\Laravel\Encrypted\Tests;

use Illuminate\Support\Facades\Response;
use Swis\Laravel\Encrypted\BinaryFileResponse;

class ResponseMacroTest extends TestCase
{
    /**
     * @test
     */
    public function it_makes_a_response()
    {
        /** @var \Swis\Laravel\Encrypted\BinaryFileResponse $response */
        $response = Response::downloadEncrypted(__DIR__.'/_files/read/read-0.txt');

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
    }

    /**
     * @test
     */
    public function it_makes_a_response_with_given_filename()
    {
        /** @var \Swis\Laravel\Encrypted\BinaryFileResponse $response */
        $response = Response::downloadEncrypted(__DIR__.'/_files/read/read-0.txt', 'foo-bar.txt');

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertStringContainsString('foo-bar.txt', $response->headers->get('content-disposition'));
    }

    /**
     * @test
     */
    public function it_makes_a_response_with_given_headers()
    {
        /** @var \Swis\Laravel\Encrypted\BinaryFileResponse $response */
        $response = Response::downloadEncrypted(__DIR__.'/_files/read/read-0.txt', null, ['X-Foo' => 'Bar']);

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertStringContainsString('Bar', $response->headers->get('X-Foo'));
    }

    /**
     * @test
     */
    public function it_makes_a_response_with_given_disposition()
    {
        /** @var \Swis\Laravel\Encrypted\BinaryFileResponse $response */
        $response = Response::downloadEncrypted(__DIR__.'/_files/read/read-0.txt', null, [], 'inline');

        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertStringContainsString('inline', $response->headers->get('content-disposition'));
    }
}
