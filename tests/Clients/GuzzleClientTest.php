<?php
namespace Krdinesh\Greenhouse\GreenhousePhp\Tests\Clients;

use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;

class GuzzleClientTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){
        $this->client= new GuzzleClient(['base_uri'=>"htttp://www.credibll.dev"]);
    }

    public function testGuzzleInitialization(){
        $client= new GuzzleClient(
            ['base_uri'=>"htttp://www.credibll.com"]
        );
        $this->assertInstanceOf(
            'Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient',
            $client
        );
        $this->assertInstanceOf('\GuzzleHttp\Client', $client->getClient());
    }

    public function testGetException(){
        $errorUrl = 'https://api.greenhouse.io/v1/boards/exception_co/embed/';
        $client= new GuzzleClient(
            ['base_uri'=>$errorUrl]
        );
        $this->expectException('Krdinesh\Greenhouse\GreenhousePhp\Clients\Exceptions\GreenhouseResponseException');
        $client->get('jobs');
    }

    public function testFormatPostParametersWithoutFiles(){
        $postVar=[
            "firstname"=>"Dinesh",
            "lastname"=>"Kumar",
            "email"=>"dinesh@radiansys.com",
            "talent"=>["stuff1","stuff2","stuff3","stuff4"]
        ];
        $excepted=[
            ["name"=>"firstname", "contents"=>"Dinesh"],
            ["name"=>"lastname", "contents"=>"Kumar"],
            ["name"=>"email", "contents"=>"dinesh@radiansys.com"],
            ["name"=>"talent[]", "contents"=>"stuff1"],
            ["name"=>"talent[]", "contents"=>"stuff2"],
            ["name"=>"talent[]", "contents"=>"stuff3"],
            ["name"=>"talent[]", "contents"=>"stuff4"]
        ];

        $this->assertEquals($excepted , $this->client->formatPostParameters($postVar));
    }
}