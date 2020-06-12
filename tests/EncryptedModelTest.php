<?php

namespace Swis\Laravel\Encrypted\Tests;

use Illuminate\Database\Eloquent\Builder;
use Swis\Laravel\Encrypted\EncryptedModel;

class EncryptedModelTest extends TestCase
{
    /**
     * @test
     */
    public function it_decrypts_raw_attributes()
    {
        // arrange
        $value = 'secret';
        $rawValue = 'eyJpdiI6ImJ1ZzZJeEd3bzVDeTJPZEtPYVRLR0E9PSIsInZhbHVlIjoiWDh2YjVjbmdkZDE2WDZOS0JtMHc4QT09IiwibWFjIjoiNDc1OWZhZjc2ZWVlY2U3ZDIwMDdkZTE4YzAxZDU4OTc1NzhmMWE3ZGUyNTI4NzQ0ZjBlNTE4OGUxMjE0NDI4OSJ9';
        $model = $this->getModelInstance();

        // act
        $model->setRawAttributes(['secret' => $rawValue]);

        // assert
        $this->assertEquals($value, $model->getAttribute('secret'));
    }

    /**
     * @test
     */
    public function it_does_not_decrypt_raw_attributes_that_are_not_provided()
    {
        // arrange
        $value = 'foo-bar';
        $model = $this->getModelInstance();

        // act
        $model->setRawAttributes(['not_secret' => $value]);

        // assert
        $this->assertEquals($value, $model->getAttribute('not_secret'));
    }

    /**
     * @test
     */
    public function it_does_not_decrypt_raw_attributes_that_are_null()
    {
        // arrange
        $model = $this->getModelInstance();

        // act
        $model->setRawAttributes(['secret' => null]);

        // assert
        $this->assertNull($model->getAttribute('secret'));
    }

    /**
     * @test
     */
    public function it_does_not_decrypt_raw_attributes_that_are_not_encrypted()
    {
        // arrange
        $value = 'foo-bar';
        $model = $this->getModelInstance();

        // act
        $model->setRawAttributes(['secret' => $value]);

        // assert
        $this->assertEquals($value, $model->getAttribute('secret'));
    }

    /**
     * @test
     */
    public function it_encrypts_data_on_insert()
    {
        // arrange
        $attributes = ['secret' => 'secret'];

        /** @var \PHPUnit\Framework\MockObject\MockObject&\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->addMethods(['getConnection', 'insertGetId'])
            ->getMock();
        $query->expects($this->once())
            ->method('insertGetId')
            ->with($this->logicalNot($this->equalTo($attributes)), 'id')
            ->willReturn(1);
        $model = $this->getModelInstance($query);

        // act
        $model->fill($attributes)->save();

        // assert
        // expectations
    }

    /**
     * @test
     */
    public function it_encrypts_data_on_update()
    {
        // arrange
        $attributes = ['secret' => 'secret'];

        /** @var \PHPUnit\Framework\MockObject\MockObject&\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['where', 'update'])
            ->getMock();
        $query->method('where')
            ->willReturnSelf();
        $query->expects($this->once())
            ->method('update')
            ->with($this->logicalNot($this->equalTo($attributes)));
        $model = $this->getModelInstance($query, true);

        // act
        $model->update($attributes);

        // assert
        // expectations
    }

    private function getModelInstance(Builder $query = null, bool $exists = false): EncryptedModel
    {
        return new class($query, $exists) extends EncryptedModel {
            protected $guarded = [];

            public $timestamps = false;

            protected $encrypted = ['secret'];

            private $query;

            public function __construct(Builder $query = null, $exists = false)
            {
                parent::__construct([]);

                $this->query = $query;
                $this->exists = $exists;
            }

            public function newModelQuery()
            {
                return $this->query;
            }
        };
    }
}
