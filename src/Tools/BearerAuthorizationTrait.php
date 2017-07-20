<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Tools;

trait BearerAuthorizationTrait
{
    /**
     * Returns authorization headers for the 'bearer' grant.
     * @param  mixed|null $token Either a string or an access token instance
     * @return Array
     */
    protected function getAuthorizationHeader($apiKey = null){
        return  ['Authorization' => 'Bearer '. $apiKey];
    }
}