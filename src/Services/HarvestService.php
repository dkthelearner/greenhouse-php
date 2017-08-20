<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Tools\HarvestHelper;

class HarvestService extends Service {

    use HarvestHelper;

    private $harvest;

    public function __construct($apiKey) {
        $this->apiKey              = $apiKey;
        $client                    = new GuzzleClient(['base_uri' => self::HARVEST_V1_URL]);
        $this->setClient($client);
        $this->authorizationHeader = $this->getAuthorizationHeader($apiKey);
    }

    public function getHarvest() {
        return $this->harvest;
    }

    public function sendRequest() {
        $allHeaders = array_merge($this->harvest['headers'], ['Authorization' => $this->authorizationHeader]);
        $requestUrl = $this->addQueryString($this->harvest['url'], $this->harvest['parameters']);
        $options    = array(
            'headers' => $allHeaders,
            'body'    => $this->harvest['body'],
        );
        return $this->client->send($this->harvest['method'], $requestUrl, $options);
    }

    public function getActivityFeedForCandidate($parameters = array()) {
        $this->harvest = $this->parse('getActivityFeedForCandidate', $parameters);
        return $this->trimUrlAndSendRequest();
    }

    public function postNoteForCandidate($parameters = array()) {
        $this->harvest        = $this->parse('postActivityFeedForCandidate', $parameters);
        $this->harvest['url'] = 'candidates/' . $parameters['id'] . '/activity_feed/notes';
        $this->sendRequest();
    }

    public function putAnonymizeCandidate($parameters = array()) {
        $this->harvest = $this->parse('putAnonymizeForCandidate', $parameters);
        return $this->trimUrlAndSendRequest();
    }

    public function getJobPostsForJob($parameters = array()) {
        $this->harvest = $this->parse('getJobPostForJob', $parameters);
        return $this->trimUrlAndSendRequest();
    }

    public function getJobStagesForJob($parameters = array()) {
        $this->harvest = $this->parse('getStagesForJob', $parameters);
        return $this->sendRequest();
    }

    public function getCurrentOfferForApplication($parameters = array()) {
        $this->harvest        = $this->parse('getOffersForApplication', $parameters);
        $this->harvest['url'] = $this->harvest['url'] . '/current_offer';
        return $this->sendRequest();
    }

    public function postAdvanceApplication($parameters = array()) {
        $this->harvest = $this->parse('postAdvanceForApplication', $parameters);
        return $this->trimUrlAndSendRequest();
    }

    public function postMoveApplication($parameters = array()) {
        $this->harvest = $this->parse('postMoveForApplication', $parameters);
        return $this->trimUrlAndSendRequest();
    }

    public function postRejectApplication($parameters = array()) {
        $this->harvest = $this->parse('postRejectForApplication', $parameters);
        return $this->trimUrlAndSendRequest();
    }

    private function trimUrlAndSendRequest() {
        $this->harvest['url'] = substr($this->harvest['url'], 0, -1);
        return $this->sendRequest();
    }

    public function __call($functionName, $arguments = []) {
        $args          = count($arguments) ? $arguments[0] : [];
        $this->harvest = $this->parse($functionName, $args);
        return $this->sendRequest();
    }

}
