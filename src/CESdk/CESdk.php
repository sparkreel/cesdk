<?php
/**
 * User: Tabaré Caorsi <tabare@heapstersoft.com>
 * Date: 7/10/14
 * Time: 2:08 PM
 */

namespace CESdk;

use CESdk\Models\Campaign;
use CESdk\Utils\Collection;
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

    /**
     * @return Campaign[]
     */
    public function getCampaigns()
    {
        $res = $this->getClient()->get('campaigns');

        $result = $res->json();

        if ($result['code'] != '200') {
            return false;
        }

        $collection  = new Collection();

        foreach($result['results'] as $c) {
            $collection->add(Campaign::createFromArray($c, $this));
        }

        return $collection;
    }

    public function updateCampaign(Campaign $campaign)
    {
        $client = $this->getClient();
        $res = $client->put('campaigns/'.$campaign->getId(), array(
            "body"=>array(
                "campaignId"=>$campaign->getId(),
                "client_name"=>$campaign->getClientName(),
                "name"=>$campaign->getName(),
                "start_date"=>$campaign->getStartDate()->format('Y-m-d H:i:s'),
                "end_date"=>$campaign->getEndDate()->format('Y-m-d H:i:s'),
                "max_age"=>$campaign->getMaxAge()->format('Y-m-d H:i:s'),
                "status"=>$campaign->getStatus(),
                "exclude_instagram_comments"=>$campaign->getExcludeInstagramComments() ? 1 : 0,
            ),
        ));

        $result = $res->json();

        if (!$result['code'] == '200') {
            throw new Exception('Error while trying to update campaign');
        }

        return Campaign::createFromArray($result['results']);
    }

    public function createCampaign($name, $clientName, array $keywords, array $sources, \DateTime  $startDate, \DateTime  $endDate,
                                   \DateTime  $maxAge, $status=0, $excludeInstagramComments = false) {

        if ($endDate < new \DateTime()) {
            throw new Exception("End date can't be in the past");
        }

        $client = $this->getClient();
        $res = $client->post('campaigns', array(
            "body"=>array(
                "client_name"=>$clientName,
                "name"=>$name,
                "start_date"=>$startDate->format('Y-m-d H:i:s'),
                "end_date"=>$endDate->format('Y-m-d H:i:s'),
                "max_age"=>$maxAge->format('Y-m-d H:i:s'),
                "status"=>$status,
                "exclude_instagram_comments"=>$excludeInstagramComments ? 1 : 0,
                "keywords"=>implode('|', $keywords),
                "sources"=>implode('|', $sources),
            ),
        ));

        $result = $res->json();

        if (!$result['code'] == '200') {
            throw new Exception('Error while trying to create campaign');
        }

        $campaign = Campaign::createFromArray($result['results'], $this);

        return $campaign;
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