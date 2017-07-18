<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Services;


use Krdinesh\Greenhouse\GreenhousePhp\Exceptions\GreenhouseException;
use Krdinesh\Greenhouse\GreenhousePhp\Services\Exception\GreenhouseServiceException;

/**
 * Undocumented class
 */
class Service {
    
    protected $client;   // Guzzle Implemetation instance
    protected $boardToken;  // board token 
    protected $apiKey;       // access key  for 'ingestion' and 'job api service'
    protected $authorizationHeader;
    
    const APPLICATION_URL = 'https://api.greenhouse.io/v1/applications/';
    const API_V1_URL = 'https://api.greenhouse.io/v1/';
    const HARVEST_V1_URL = 'https://harvest.greenhouse.io/v1/';
    const GREENHOUSE_PARTNER_V1_URL = 'https://api.greenhouse.io/v1/partner/';

    public function getClient(){
        return $this->client;
    }

    public function setClient($client){
         $this->client = $client;
    }

    public static function jobBoardBaseUrl($boardToken){
        return self::API_V1_URL . "boards/{$boardToken}/embed/";
    }

    public static function ingestionApiBaseUrl(){
        return self::GREENHOUSE_PARTNER_V1_URL;
    }

    public function getIngestionApiBaseUrl(){
        return self::GREENHOUSE_PARTNER_V1_URL;
    }

    public function getJobBoardBaseUrl(){
        if (empty($this->boardToken)) {
            throw new GreenhouseServiceException('A client token must be defined to get the base URL.');
        }
        return self::jobBoardBaseUrl($this->boardToken);
    }

}

