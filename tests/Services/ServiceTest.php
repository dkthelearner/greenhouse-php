<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Test\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\JobService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->apiService = new Service();
    }

    public function testjobBoardBaseUrl(){
        $excepted = "https://api.greenhouse.io/v1/boards/test_token/embed/";
        $this->assertEquals($excepted,Service::jobBoardBaseUrl('test_token'));
    }

    public function testingestionApiBaseUrl(){
        $excepted = "https://api.greenhouse.io/v1/partner/";
        $this->assertEquals($excepted,Service::INGESTION_V1_URL);
    }

    public function testgetIngestionBaseUrl(){
        $ingestionService= new IngestionService('apikey');
        $excepted = "https://api.greenhouse.io/v1/partner/";
        $this->assertEquals($excepted,$this->apiService->getIngestionBaseUrl());
    }

    public function testGetjobBoardBaseUrl(){
        $jobService=new JobService('test_token');
        $excepted = "https://api.greenhouse.io/v1/boards/test_token/embed/";
        $this->assertEquals($excepted,$jobService->getjobBoardBaseUrl());
    }     
}

