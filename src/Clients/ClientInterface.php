<?php

namespace Krdinesh\Greenhouse\GreenhousePhp\Clients;

/**
 * Guzzle Wrapper Interface
 */
interface ClientInterface {

    /**
     * Get the response from the URL and return the JSON response from the Greenhouse server.
     */
    public function get($url);

    /**
     * Post parameters as formatted by $this->formatPostParameters and send it to the destination URL.
     * @param Array $postParams
     * @param Array $header
     * @param string $url
     * @throws  GreenhouseServiceResponseException  for non-200 responses
     */
    public function post(Array $postParams, Array $header, $url);

   /**
     * Transform the post parameters that client understands.
     * @params  Array   $postParamters      
     * @return  mixed   
     */
    public function formatPostParameters(Array $postParameters);

    /**
     * Send Request
     *
     * @param Array $postParameters
     * @param [type] $url
     * @return void
     */
    public function send($method,$url,Array $options);
}