<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Test\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\JobApiService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\IngestionApiService;
use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->apiService = new Service();
    }

    public function testJobBoardBaseUrl(){
        $excepted = "https://api.greenhouse.io/v1/boards/test_token/embed/";
        $this->assertEquals($excepted,Service::jobBoardBaseUrl('test_token'));
    }

    public function testingestionApiBaseUrl(){
        $excepted = "https://api.greenhouse.io/v1/partner/";
        $this->assertEquals($excepted,Service::GREENHOUSE_PARTNER_V1_URL);
    }

    public function testGetIngestionApiBaseUrl(){
        $ingestionService= new IngestionApiService('apikey');
        $excepted = "https://api.greenhouse.io/v1/partner/";
        $this->assertEquals($excepted,$this->apiService->getIngestionApiBaseUrl());
    }

    public function testGetJobBoardBaseUrl(){
        $jobService=new JobApiService('test_token');
        $excepted = "https://api.greenhouse.io/v1/boards/test_token/embed/";
        $this->assertEquals($excepted,$jobService->getJobBoardBaseUrl());
    }

    
    
       
}

