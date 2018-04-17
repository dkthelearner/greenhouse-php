<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Services;

use Krdinesh\Greenhouse\GreenhousePhp\Services\Service;
use Krdinesh\Greenhouse\GreenhousePhp\Clients\GuzzleClient;
use Krdinesh\Greenhouse\GreenhousePhp\Tools\QueryBuilderTrait;

class IngestionService extends Service
{
    use QueryBuilderTrait;

    public function __construct($apikey, $isBasicHeader = null)
    {
        $client       = new GuzzleClient(['base_uri' => self::INGESTION_V1_URL]);
        $this->setClient($client);
        $this->apiKey = $apikey;
        if ($isBasicHeader) {
            $this->authorizationHeader = array_merge($this->getAuthorizationHeader($this->apiKey), [
                'On-Behalf-Of' => $isBasicHeader
            ]);
        } else {
            $this->authorizationHeader = $this->getBearerAuthorizationHeader($this->apiKey);
        }
    }

    /**
     * GET $baseUrl/jobs
     * @param   boolean     $content    Append the content parameters to get the job post content, department, and office.
     * @return  string      JSON response string from Greenhouse API.
     * @throws  GreenhouseResponseException for non-200 responses
     */
    public function getJobs()
    {
        return $this->client->send('GET', 'jobs', [
                    'headers' => $this->authorizationHeader
        ]);
    }

    public function getCandidates($ids)
    {
        $url = 'candidates?' . $this->buildQueryString([
          'candidate_ids' => $ids
        ]);
        return $this->client->send('GET', $url, [
                    'headers' => $this->authorizationHeader
        ]);
    }

    public function postCandidates(array $postVar)
    {
        return $this->client->post($this->client->formatPostParameters($postVar), $this->authorizationHeader, 'candidates');
    }
}
