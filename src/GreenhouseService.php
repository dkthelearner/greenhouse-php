<?php

namespace Krdinesh\Greenhouse\GreenhousePhp;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Services\JobApiService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionApiService;


class GreenhouseService {

    private $apiKey;
    private $boardToken;
    
    public function __construct($options=array()){
        $this->apiKey      = isset($options['apiKey'])     ? $options['apiKey']     : null;
        $this->boardToken  = isset($options['boardToken']) ? $options['boardToken'] : null;
    }
    
    public function getJobApiService(){
        $jobService = new JobApiService($this->boardToken);
        $client = new GuzzleClient([
            ['base_uri' => Service::jobBoardBaseUrl($boardToken)]
        ]);
        $jobService->setClient($client);
        return $jobService;
    }
    
    public function getIngestionService(){
        $ingestionService = new IngestionApiService($this->apiKey);
        $client = new GuzzleClient([
            ['base_uri' => Service::ingestionApiBaseUrl()]
        ]);
        $ingestionService->setClient($client);
        return $ingestionService;
    }
}