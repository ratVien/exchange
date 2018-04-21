<?php

namespace Rate\Services;

use GuzzleHttp\Client;
use Rate\Helpers\RateHelper;

class RBCExchanger extends Exchanger
{
    use RateHelper;

    private $url = 'https://cash.rbc.ru/cash/json/converter_currency_rate/';

    public function exchange($date)
    {
        $rate['USD'] = $this->getRate($date, 'USD');
        $rate['EUR'] = $this->getRate($date, 'EUR');

        return $rate;
    }

    private function getRate($date, $currency)
    {
        $url = $this->url . "?currency_from=$currency&currency_to=RUR&source=cbrf&sum=1&date=$date";
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $url,
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET');
        $result = $response->getBody()->getContents();
        $result = \GuzzleHttp\json_decode($result);

        return $result->data->sum_result;
    }
}