<?php
/**
 * Created by PhpStorm.
 * User: ratvien
 * Date: 18.04.18
 * Time: 19:21
 */
//require_once __DIR__ . '/vendor/autoload.php';
//namespace Rate;

use Rate\CdrExchanger;

class Rate
{
    public function getExchangeRates($date)
    {
        $cbr = new CdrExchanger();
        return $cbr->exchange($date);
}
}

$rate = new Rate();
print_r($rate->getExchangeRates('2018-04-17'));