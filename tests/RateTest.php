<?php

namespace Rate\tests;

use PHPUnit\Framework\TestCase;
use Rate\Rate;

class RateTest extends TestCase
{

    public function testGetExchangeRates()
    {
        $rate = new Rate();
        $this->assertArrayHasKey('USD', $rate->getExchangeRates('2018-04-17'));
    }

    public function testWrongDateException()
    {
        $this->expectExceptionMessage('Date is not valid!');
        $rate = new Rate();
        $rate->getExchangeRates('2018/04-17');
    }
}