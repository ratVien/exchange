<?php

namespace Rate\Services;

use GuzzleHttp\Client;
use Rate\Helpers\RateHelper;

class CdrExchanger extends Exchanger
{
    use RateHelper;

    private $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
    private $cdrDateFormat = 'd/m/Y';

    public function exchange($date)
    {
        $date = $this->convertDate($date, $this->cdrDateFormat);
        $url = $this->url . "?date_req=" . $date;
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $url,
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        $response = $client->request('GET');
        $xml = simplexml_load_string($response->getBody()->getContents());
        $rate = [];

        foreach ($xml->Valute as $valute) {
            if ($valute->CharCode == 'USD') {
                $rate['USD'] = (float)str_replace(',', '.', (string)$valute->Value);
            }
            if ($valute->CharCode == 'EUR') {
                $rate['EUR'] = (float)str_replace(',', '.', (string)$valute->Value);
            }
        }

        return $rate;
    }

}