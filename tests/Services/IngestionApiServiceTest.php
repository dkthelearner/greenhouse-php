<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Test\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionApiService;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\Exceptions\GreenhouseResponseException;

class IngestionApiServiceTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->ingestionService = new IngestionApiService('apiKey');
        $this->errorService = new IngestionApiService('exception_api_key');
        $this->baseUrl =  IngestionApiService::ingestionApiBaseUrl();
    }

    public function testGetJobsException(){
        $this->expectException('Krdinesh\Greenhouse\GreenhousePhp\Clients\Exceptions\GreenhouseResponseException');
        $this->errorService->getJobs();
    }
}