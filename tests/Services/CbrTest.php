<?php

namespace Rate\tests\Services;

use PHPUnit\Framework\TestCase;
use Rate\Services\Cbr;

class CbrTest extends TestCase
{

    public function testSuccess()
    {
        $cbr = new Cbr('2018-04-17');
        $this->assertArrayHasKey('USD', $cbr->rates);
    }
}
