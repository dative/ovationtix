<?php

namespace Dative\OvationTix\Traits;

use Dative\OvationTix\HTTPClient;
use Dative\OvationTix\Errors\HTTPClientNotFound;

trait UseHttpClient 
{
    // @var GuzzleHttp\Client HTTP client for requests
    protected $httpClient;

    /**
     * Set HttpClient
     *
     * @param Dative\OvationTix\HttpClient $httpClient
     **/
    protected function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Check if HttpClient is set
     *
     * @throws Dative\OvationTix\Errors\HTTPClient
     **/
    protected function hasHttpClient()
    {
        if (!$this->httpClient instanceof HttpClient) {
            throw new HTTPClientNotFound("HttpClient Error: this instance doesn't have httpClient set.");
        }
    }
}