<?php 


namespace Krdinesh\Greenhouse\GreenhousePhp\Tests;

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
    public function testJobService(){
        $jobService=$this->greenhouseService->getJobService();
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient', $jobService->getClient()); 
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Services\JobService', $jobService);     
        $this->assertEquals(
            'https://api.greenhouse.io/v1/boards/test_token/embed/',
            $jobService->getjobBoardBaseUrl()
        );
    }

    public function testIngestionService(){
        $ingestionService=$this->greenhouseService->getIngestionService();
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient', $ingestionService->getClient()); 
        $this->assertInstanceOf('\Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionService', $ingestionService);     
        $this->assertEquals(
            'https://api.greenhouse.io/v1/partner/',
            $ingestionService->getIngestionBaseUrl()
        );
    }

    public function testGetHarvestService(){
        $service = $this->greenhouseService->getHarvestService();
        $this->assertInstanceOf(
            '\Krdinesh\Greenhouse\GreenhousePhp\Services\HarvestService',
            $service
        );
        $authHeader = 'Basic ' . base64_encode($this->apiKey . ':');
        $this->assertEquals($authHeader, $service->getAuthorizationHeader());
    }
}