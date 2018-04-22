<?php

namespace Rate;

use Rate\Helpers\RateHelper;
use Rate\Services\Cbr;
use Rate\Services\Rbc;

class Rate
{
    use RateHelper;

    /**
     * @param $date
     * @return array
     * @throws \Exception
     */
    public function getExchangeRates($date)
    {
        $this->validateDate($date);
        $cbr = new Cbr($date);
        $rbc = new Rbc($date);

        return $this->getAverageRates($cbr->rates, $rbc->rates);
    }

    /**
     * array_sum($values) / count($values)
     * @param array $rates1
     * @param array $rates2
     * @return array
     */
    private function getAverageRates($rates1, $rates2)
    {
        $avgRate['USD'] = ($rates1['USD'] + $rates2['USD']) / 2;
        $avgRate['EUR'] = ($rates1['EUR'] + $rates2['EUR']) / 2;
        return $avgRate;
    }
}