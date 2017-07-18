<?php 


namespace Krdinesh\Greenhouse\GreenhousePhp\Tests;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\GreenhouseService;

class GreehouseServiceTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->apiKey       = 'testapikey';
        $this->boardToken   = 'test_token';
        $this->greenhouseService = new GreenhouseService([
            'apiKey'    => $this->apiKey,
            'boardToken'=> $this->boardToken
        ]);
    }

    public function testConstructWithNoApiKey(){
        $service =new GreenhouseService(['apiKey'=>"apiKey"]);
        $this->assertInstanceOf(
            'Krdinesh\Greenhouse\GreenhousePhp\GreenhouseService',
            $service
        );
    }

    public function testConstructWithNoBoardToken(){
        $service = new GreenhouseService(['boardToken'=>"boardToken"]);
        $this->assertInstanceOf(
            'Krdinesh\Greenhouse\GreenhousePhp\GreenhouseService',
            $service
        );
    }
    public function testJobApiService(){
        $jobService=$this->greenhouseService->getJobApiService();
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient', $jobService->getClient()); 
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Services\JobApiService', $jobService);     
        $this->assertEquals(
            'https://api.greenhouse.io/v1/boards/test_token/embed/',
            $jobService->getJobBoardBaseUrl()
        );
    }

    public function testIngestionService(){
        $ingestionService=$this->greenhouseService->getIngestionService();
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient', $ingestionService->getClient()); 
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionApiService', $ingestionService);     
        $this->assertEquals(
            'https://api.greenhouse.io/v1/partner/',
            $ingestionService->getIngestionApiBaseUrl()
        );
    }
}