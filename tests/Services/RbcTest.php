<?php

namespace Rate\tests\Services;

use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use Rate\Services\Rbc;

class RbcTest extends TestCase
{

    public function testSuccess()
    {
        $rbc = new Rbc('2018-04-17');
        $this->assertArrayHasKey('USD', $rbc->rates);
    }

    public function testWrongDateException()
    {
        $this->expectException(ClientException::class);
        $rbc = new Rbc('2018/04-17');
    }
}
