<?php

namespace Rate\Services;

use GuzzleHttp\Client;
use Rate\Helpers\RateHelper;

class Rbc extends Exchanger
{
    use RateHelper;

    private $url = 'https://cash.rbc.ru/cash/json/converter_currency_rate/';
    public $rates;

    public function __construct($date)
    {
        $this->rates['USD'] = $this->getRate($date, 'USD');
        $this->rates['EUR'] = $this->getRate($date, 'EUR');
    }

    /**
     * @param string $date
     * @param string $currency
     * @return float
     * @throws \Exception
     */
    private function getRate($date, $currency)
    {
        $client = new Client([
            'timeout' => 2.0,
        ]);
        $params = [
            'query' => [
                'currency_from' => $currency,
                'currency_to' => 'RUR',
                'source' => 'cbrf',
                'sum' => 1,
                'date' => $date,
            ]
        ];
        $response = $client->request('GET', $this->url, $params);

        if ($response->getStatusCode() > 201) {
            throw new \Exception("Error! Service " . $this->url . " unavailable!");
        }
        $result = $response->getBody()->getContents();
        $result = \GuzzleHttp\json_decode($result);

        return $result->data->sum_result;
    }
}