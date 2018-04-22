<?php

namespace Rate\Services;

use GuzzleHttp\Client;
use Rate\Helpers\RateHelper;

class Cbr extends Exchanger
{
    use RateHelper;

    private $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
    private $cdrDateFormat = 'd/m/Y';
    public $rates;

    /**
     * Cbr constructor.
     * @param string $date
     * @throws \Exception
     */
    public function __construct($date)
    {
        $date = $this->convertDate($date, $this->cdrDateFormat);
        $client = new Client([
            'timeout' => 2.0,
        ]);

        $params = ['query' => ['date_req' => $date]];
        $response = $client->request('GET', $this->url, $params);

        if ($response->getStatusCode() > 201) {
            throw new \Exception("Error! Service " . $this->url . " unavailable!");
        }

        $xml = simplexml_load_string($response->getBody()->getContents());

        foreach ($xml->Valute as $valute) {
            if ($valute->CharCode == 'USD') {
                $this->rates['USD'] = (float)str_replace(',', '.', (string)$valute->Value);
            }
            if ($valute->CharCode == 'EUR') {
                $this->rates['EUR'] = (float)str_replace(',', '.', (string)$valute->Value);
            }
        }
    }
}