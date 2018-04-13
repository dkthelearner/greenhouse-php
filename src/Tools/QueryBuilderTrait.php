<?php 

namespace Krdinesh\Greenhouse\GreenhousePhp\Tools;

trait QueryBuilderTrait
{
    /**
     * Returns build QueryString headers
     * @return array
     */
    protected function buildQueryString($params)
    {
        return http_build_query($params, '', '&', \PHP_QUERY_RFC1738);
    }
}
