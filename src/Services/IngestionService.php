<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Tools\BearerAuthorizationTrait;
use Krdinesh\Greenhouse\GreenhousePhp\Tools\QueryBuilderTrait;

class IngestionService extends Service {
    use BearerAuthorizationTrait;
    use QueryBuilderTrait;

    public function __construct($apikey){
        $client = new GuzzleClient(['base_uri' => self::INGESTION_V1_URL]);
        $this->setClient($client);
        $this->apiKey = $apikey;
        $this->authorizationHeader = $this->getAuthorizationHeader($this->apiKey); 
             
    }
   /**
     * GET $baseUrl/jobs
     * @param   boolean     $content    Append the content paramenter to get the job post content, department, and office.
     * @return  string      JSON response string from Greenhouse API.
     * @throws  GreenhouseResponseException for non-200 responses
     */
    public function getJobs(){
        return $this->client->send('GET','jobs',[
                'headers' => $this->authorizationHeader
        ]);
    }

    public function getCandidates($ids){
        $url = $ids?'candidates':'candidates?'.$this->buildQueryString();
        return $this->client->send('GET',$url,[
            'headers' => $this->authorizationHeader
        ]);
    }

    public function postCandidates(Array $postVar){
        return $this->client->post($this->client->formatPostParameters($postVar),[
                'headers' => $this->authorizationHeader
        ],'candidates');
    }
}