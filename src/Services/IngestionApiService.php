<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Tools\BearerAuthorizationTrait;

class IngestionApiService extends Service {
    use BearerAuthorizationTrait;

    public function __construct($apikey){
        $client = new GuzzleClient(['base_uri' => self::GREENHOUSE_PARTNER_V1_URL]);
        $this->setClient($client);
        $this->apiKey = $apikey;
        $this->authorizationHeader = $this->getAuthorizationHeader();      
    }
   /**
     * GET $baseUrl/jobs
     * @param   boolean     $content    Append the content paramenter to get the job post content, department, and office.
     * @return  string      JSON response string from Greenhouse API.
     * @throws  GreenhouseAPIResponseException for non-200 responses
     */
    public function getJobs(){
        return $this->apiClient->send('GET','jobs',[
                'headers' => ['Authorization' => $this->_authorizationHeader],
        ]);
    }
}