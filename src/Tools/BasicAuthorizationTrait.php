<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Tools;

trait BasicAuthorizationTrait
{
    /**
     * Returns authorization headers for the 'bearer' grant.
     * @param  mixed|null $token Either a string or an access token instance
     * @return array
     */
    protected function getAuthorizationHeader($token = null)
    {
        return 'Basic ' . $token;
    }
}