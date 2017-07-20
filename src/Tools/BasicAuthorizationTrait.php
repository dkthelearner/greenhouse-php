<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Tools;

trait BasicAuthorizationTrait
{
    /**
     * Returns authorization headers for the 'Basic' grant.
     * @param  mixed|null $token Either a string or an access token instance
     * @return Array
     */
    protected function getAuthorizationHeader($apiKey = null){
        return  ['Authorization' => 'Basic '. $apiKey];
    }
}