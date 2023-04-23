<?php

namespace App;

use SimpleXMLElement;

class CurrencyConverter
{
    private getApiClient $client;
    private SimpleXMLElement $xmlData;

    public function __construct()
    {
        $this->client = new getApiClient();
        $this->xmlData = $this->client->fetchData();
    }

    /**
     * @throws \Exception
     */
    public function convert(float $amount, string $toCurrency): float
    {
        foreach ($this->xmlData->Currencies->Currency as $currency) {
            if ($currency->ID == $toCurrency) {
                return $currency->Rate * $amount;
            }
        }

        throw new \Exception('Invalid currency code');
    }
}
