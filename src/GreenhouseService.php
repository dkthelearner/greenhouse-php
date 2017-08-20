<?php

namespace Krdinesh\Greenhouse\GreenhousePhp;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Services\JobService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\HarvestService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\JobBoardService;

class GreenhouseService {

    private $apiKey;
    private $boardToken;
    
    public function __construct($options=array()){
        $this->apiKey      = isset($options['apiKey'])     ? $options['apiKey']     : null;
        $this->boardToken  = isset($options['boardToken']) ? $options['boardToken'] : null;
    }
    
    public function getJobService(){
        $jobService = new JobService($this->boardToken);
        $client = new GuzzleClient([
                'base_uri' => Service::jobBoardBaseUrl($this->boardToken)
            ]);
        $jobService->setClient($client);
        return $jobService;
    }
    
    public function getIngestionService(){
        $ingestionService = new IngestionService($this->apiKey);
        $client = new GuzzleClient([
                'base_uri' => Service::ingestionBaseUrl()
            ]);
        $ingestionService->setClient($client);
        return $ingestionService;
    }

    public function getJobBoardService(){
        return new JobBoardService($this->_boardToken);
    }
    
    public function getHarvestService(){
        return new HarvestService($this->apiKey);
    }
}