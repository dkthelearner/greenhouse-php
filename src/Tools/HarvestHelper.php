<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Tools;

use Krdinesh\Greenhouse\GreenhousePhp\Tools\QueryBuilderTrait;
use Krdinesh\Greenhouse\GreenhousePhp\Exceptions\GreenhouseException;

trait HarvestHelper
{
    use QueryBuilderTrait;

    protected function addQueryString($url, $parameters = [])
    {
        if (!count($parameters)) {
            return $url;
        }
        return $url . "?" . $this->buildQueryString($parameters);
    }

    protected function parse($methodName, $parameters = [])
    {
        $parseResult = [];

        $pattern   = '/^(get|post|patch|put|delete)(\w+)$/i';
        $isMatched = preg_match($pattern, $methodName, $matches);
        if (!$isMatched) {
            throw new GreenhouseException("Harvest Service: invalid method $methodName.");
        }
        $parseResult['method'] = $matches[1];
        $parseResult['url']    = $this->getEndpoint($matches[2], $parameters);

        if (isset($parameters['id'])) {
            unset($parameters['id']);
        }

        if (isset($parameters['headers'])) {
            $parseResult['headers'] = $parameters['headers'];
            unset($parameters['headers']);
        } else {
            $parseResult['headers'] = [];
        }

        if (isset($parseResult['body'])) {
            $parseResult['body'] = $parameters['body'];
            unset($parameters['body']);
        } else {
            $parseResult['body'] = null;
        }
        $parseResult['parameters'] = $parameters;
        return $parseResult;
    }

    protected function getEndpoint($methodText, $parameters = [])
    {
        $id      = isset($parameters['id']) ? $parameters['id'] : null;
        $objects = \explode('For', $methodText);
        if (sizeOf($objects) == 1) {
            $url = $this->decamelizeAndPluralize($objects[0]);
            if ($id) {
                $url .= "/$id";
            }
        } elseif (sizeof($objects) == 2) {
            if (!$id) {
                throw new GreenhouseServiceException("Harvest Service: method call $methodText must include an id parameter");
            }
            $url = $this->decamelizeAndPluralize($objects[1]) . "/$id/" . $this->decamelizeAndPluralize($objects[0]);
        } else {
            throw new GreenhouseServiceException("Harvest Service: Invalid method call $methodText.");
        }

        return $url;
    }

    protected function decamelizeAndPluralize($string)
    {
        $decamelized = strtolower(preg_replace(['/([a-z0-9])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
        if (substr($decamelized, -1) != 's') {
            $decamelized .= 's';
        }
        return $decamelized;
    }
}
