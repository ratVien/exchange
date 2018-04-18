<?php
namespace Rate;

use DateTime;
use DOMDocument;
use GuzzleHttp\Client;
use SimpleXMLElement;

class CdrExchanger extends Exchanger
{
    private $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
    private $cdrDateFormat = 'd/m/Y';

    /**
     * @param string $date
     *
     * @return string
     */
    protected function convertDate($date)
    {
        $date = DateTime::createFromFormat(self::DATE_FORMAT, $date);

        return $date->format($this->cdrDateFormat);
    }

    public function exchange($date)
    {
        $this->validateDate($date);
        $date = $this->convertDate($date);
        $url = $this->url . "?date_req=" . $date;
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $url,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $response = $client->request('GET');
        $xml = new DOMDocument();
        $xml->load($url);
        $root = $xml->documentElement;
        $items = $root->getElementsByTagName('Valute');
        foreach ($items as $item)
        {
            if ($item->getElementsByTagName('CharCode')->item(0)->nodeValue == 'USD') {
                $rate = $item->getElementsByTagName('Value')->item(0)->nodeValue;
            }
//        $xml = new SimpleXMLElement($response->getBody()->getContents());
//        $xml = simplexml_load_file($response->getBody()->getContents());

        /*return $array = $xml->Valute;
        foreach ($array as $currency) {
            return $currency;
            /*if ($currency->CharCode == 'USD') {
                $rate = $currency->Value;
            }*/
        }
        return $rate;
    }

}