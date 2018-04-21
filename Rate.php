<?php
/**
 * Created by PhpStorm.
 * User: ratvien
 * Date: 18.04.18
 * Time: 19:21
 */
require_once __DIR__ . '/vendor/autoload.php';

//namespace Rate;

use Rate\Helpers\RateHelper;
use Rate\Services\CdrExchanger;
use Rate\Services\RBCExchanger;

class Rate
{
    use RateHelper;

    /**
     * @param $date
     * @return array
     * @throws Exception
     */
    public function getExchangeRates($date)
    {
        $this->validateDate($date);
        $cbr = new CdrExchanger();
        $cbrRate = $cbr->exchange($date);
        $rbc = new RBCExchanger();
        $rbcRate = $rbc->exchange($date);


        return $this->getAverageRates($cbrRate, $rbcRate);
    }

    /**
     * array_sum($values) / count($values)
     * @param array $rate1
     * @param array $rate2
     * @return array
     */
    private function getAverageRates($rate1, $rate2)
    {
        $avgRate['USD'] = ($rate1['USD'] + $rate2['USD']) / 2;
        $avgRate['EUR'] = ($rate1['EUR'] + $rate2['EUR']) / 2;
        return $avgRate;
    }
}

$rate = new Rate();
print_r($rate->getExchangeRates('2019/04-17'));