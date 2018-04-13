<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Tools;

trait JsonTrait
{
    private function decodeToObjects($json)
    {
        return json_decode($json, false);
    }
    
    private function decodeToHash($json)
    {
        return json_decode($json, true);
    }
}
