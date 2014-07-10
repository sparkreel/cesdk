<?php
/**
 * User: Tabaré Caorsi <tabare@heapstersoft.com>
 * Date: 7/10/14
 * Time: 2:08 PM
 */

namespace CESdk;

use GuzzleHttp\Client;

class CESdk
{
    protected $baseUrl = 'http://api.social.sparkreel.it/v1/';
    protected $apiKey = null;

    public function __construct($apiKey=null, $baseUrl=null)
    {
        if (!empty($apiKey)) {
            $this->apiKey = $apiKey;
        }

        if (!empty($baseUrl)) {
            $this->baseUrl = $baseUrl;
        }
    }

    /**
     * @param null $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return null
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param null|string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return null|string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getCampaigns()
    {
        $res = $this->getClient()->get('campaigns');

        $result = $res->json();

        if ($result['code'] != '200') {
            return false;
        }

        return $result;
    }


    protected function getClient()
    {
        if (empty($this->apiKey)) {
            throw new Exception('API Key must be set before sending any requests.');
        }

        if (empty($this->baseUrl)) {
            throw new Exception('Base Url must be set before sending any requests.');
        }

        $client = new Client(array(
            "base_url"=>$this->baseUrl,
            "defaults"=> array(
                'headers' => [
                    'User-Agent' => 'CESdk/1.0',
                    'Accept'     => 'application/json',
                    'X-API-KEY'  => $this->apiKey
                ]
            ),
        ));

        return $client;
    }

} 