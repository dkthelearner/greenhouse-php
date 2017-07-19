<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Tests\Services;


use Krdinesh\Greenhouse\GreenhousePhp\Services\JobApiService;

class JobApiServiceTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->jobService = new JobApiService('greenhouse');
        $this->errorService = new JobApiService('test_greenhouse');
        $this->baseUrl = JobApiService::jobBoardBaseUrl('greenhouse');
    }

    public function testGetContentQueryTrue(){
        $this->assertEquals(
            'jobs?content=true',
             $this->jobService->getContentQuery('jobs',true)
        );
    }

    public function testGetContentQuerFalse(){
        $this->assertEquals(
            'jobs',
             $this->jobService->getContentQuery('jobs',false)
        );
    }

    public function testGetQuestionsQueryTrue(){
         $this->assertEquals(
            'jobs&questions=true',
             $this->jobService->getQuestionsQuery('jobs',true)
        );
    }

    public function testGetQuestionsQueryFalse(){
        $this->assertEquals(
            'jobs',
             $this->jobService->getQuestionsQuery('jobs',false)
        );
    }

    public function testGetJobsException(){
        $this->expectException('\Krdinesh\Greenhouse\GreenhousePhp\Clients\Exceptions\GreenhouseResponseException');
        $this->errorService->getJobs();
    }

    public function testGetJobException(){
        $this->expectException('\Krdinesh\Greenhouse\GreenhousePhp\Clients\Exceptions\GreenhouseResponseException');
        $this->errorService->getJobs(123);
    }

}