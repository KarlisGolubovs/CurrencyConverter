<?php

namespace CurrencyConverter_PD\app;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;


class CurrencyConverter
{
    private Client $client;
    private array $rates;

    public function __construct()
    {
        $this->client = new Client();
        $this->rates = [];
    }

    /**
     * @throws Exception
     */
    public function getExchangeRate($from, $to)
    {
        $from = strtoupper($from);
        $to = strtoupper($to);

        if (empty($this->rates)) {
            try {
                $response = $this->client->request('GET', 'https://www.latvijasbanka.lv/vk/ecb.xml');
            } catch (GuzzleException $e) {
            }
            $xml = new SimpleXMLElement((string) $response->getBody());

            foreach ($xml->Cube->Cube->Cube as $cube) {
                $currency = (string) $cube['currency'];
                $rate = (float) $cube['rate'];
                $this->rates[$currency] = $rate;
            }

            $this->rates['EUR'] = 1.0;
        }

        if (isset($this->rates[$from]) && isset($this->rates[$to])) {
            return $this->rates[$to] / $this->rates[$from];
        } else {
            throw new Exception("Unknown currency: $from or $to");
        }
    }
}