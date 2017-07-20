<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Tests\Services;


use Krdinesh\Greenhouse\GreenhousePhp\Services\JobService;

class JobServiceTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->jobService = new JobService('greenhouse');
        $this->errorService = new JobService('test_greenhouse');
        $this->baseUrl = JobService::jobBoardBaseUrl('greenhouse');
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