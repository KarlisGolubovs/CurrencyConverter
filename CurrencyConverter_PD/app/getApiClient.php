<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use SimpleXMLElement;

class  getApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client;
    }
    public function fetchData() : SimpleXMLElement
    {
        $url = "https://www.latvijasbanka.lv/vk/ecb.xml";
        $res = $this->client->request('GET', $url);

        return simplexml_load_string($res->getBody()->getContents());
    }
}
