<?php

namespace Swis\Laravel\Encrypted\Tests;

use Illuminate\Database\Eloquent\Model;
use Swis\Laravel\Encrypted\EncryptedCast;

class EncryptedCastTest extends TestCase
{
    /**
     * @test
     */
    public function it_encrypts_data_on_set()
    {
        // arrange
        $secret = 'secret';
        $cast = new EncryptedCast();

        // act
        $result = $cast->set(
            new class extends Model {
            },
            'secret',
            $secret,
            []
        );

        // assert
        $this->assertNotEquals($secret, $result);
    }

    /**
     * @test
     */
    public function it_decrypts_data_on_get()
    {
        // arrange
        $secret = 'secret';
        $encryptedSecret = 'eyJpdiI6ImJ1ZzZJeEd3bzVDeTJPZEtPYVRLR0E9PSIsInZhbHVlIjoiWDh2YjVjbmdkZDE2WDZOS0JtMHc4QT09IiwibWFjIjoiNDc1OWZhZjc2ZWVlY2U3ZDIwMDdkZTE4YzAxZDU4OTc1NzhmMWE3ZGUyNTI4NzQ0ZjBlNTE4OGUxMjE0NDI4OSJ9';
        $cast = new EncryptedCast();

        // act
        $result = $cast->get(
            new class extends Model {
            },
            'secret',
            $encryptedSecret,
            []
        );

        // assert
        $this->assertEquals($secret, $result);
    }

    /**
     * @test
     */
    public function it_does_not_cast_null_values()
    {
        // arrange
        $cast = new EncryptedCast();

        // act
        $resultSet = $cast->set(
            new class extends Model {
            },
            'secret',
            null,
            []
        );
        $resultGet = $cast->get(
            new class extends Model {
            },
            'secret',
            null,
            []
        );

        // assert
        $this->assertNull($resultSet);
        $this->assertNull($resultGet);
    }
}
