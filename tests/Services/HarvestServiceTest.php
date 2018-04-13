<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Test\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\HarvestService;

class HarvestServiceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->harvestService = new HarvestService('greenhouse');
        $apiStub              = $this->getMockBuilder('\Greenhouse\GreenhousePhp\Client\GuzzleClient')
                ->setMethods(array('send'))
                ->getMock();
        $this->harvestService->setClient($apiStub);
        $this->expectedAuth   = ['Authorization' => 'Basic Z3JlZW5ob3VzZTo='];
    }

    public function testGetJobPosts()
    {
        $expected = array(
            'method'     => 'get',
            'url'        => 'job_posts',
            'headers'    => array(),
            'body'       => null,
            'parameters' => array()
        );
        $params   = array();
        $this->harvestService->getJobPosts($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }

    public function testGetJobPostsPaging()
    {
        $params   = array('page' => 2, 'per_page' => 100);
        $expected = array(
            'method'     => 'get',
            'url'        => 'job_posts',
            'headers'    => array(),
            'body'       => null,
            'parameters' => $params
        );

        $this->harvestService->getJobPosts($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }

    public function testGetJobPostsForJob()
    {
        $expected = array(
            'method'     => 'get',
            'url'        => 'jobs/12345/job_post',
            'headers'    => array(),
            'body'       => null,
            'parameters' => array()
        );
        $params   = array('id' => 12345);
        $this->harvestService->getJobPostsForJob($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }

    public function testGetJobStagesForJob()
    {
        $expected = array(
            'method'     => 'get',
            'url'        => 'jobs/12345/stages',
            'headers'    => array(),
            'body'       => null,
            'parameters' => array()
        );
        $params   = array('id' => 12345);
        $this->harvestService->getJobStagesForJob($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }

    public function testGetJobsNoPaging()
    {
        $expected = array(
            'method'     => 'get',
            'url'        => 'jobs',
            'headers'    => array(),
            'body'       => null,
            'parameters' => array()
        );
        $params   = array();
        $this->harvestService->getJobs($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }

    public function testGetJobsPaging()
    {
        $params   = array('page' => 2, 'per_page' => 100);
        $expected = array(
            'method'     => 'get',
            'url'        => 'jobs',
            'headers'    => array(),
            'body'       => null,
            'parameters' => $params
        );

        $this->harvestService->getJobs($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }

    public function testGetJob()
    {
        $expected = array(
            'method'     => 'get',
            'url'        => 'jobs/12345',
            'headers'    => array(),
            'body'       => null,
            'parameters' => array()
        );
        $params   = array('id' => 12345);
        $this->harvestService->getJobs($params);
        $this->assertEquals($expected, $this->harvestService->getHarvest());
        $this->assertEquals($this->expectedAuth, $this->harvestService->getAuthorizationHeader());
    }
}
