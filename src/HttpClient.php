<?php

namespace Dative\OvationTix;

use GuzzleHttp\Client;
/**
 * HttpClient class
 * 
 * Provides a common client interface for requests
 */
class HttpClient
{
    // @var string The base URL for the OvationTix REST API.
    private static $apiRESTBase = "https://api.ovationtix.com/public/";

    const HTTP_GET  = 'GET';
    const HTTP_POST = 'POST';

    // @var GuzzleHttp\Client HTTP client for requests
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Make request to API
     *
     * @param string $method
     * @param string $path
     * @return Psr\Http\Message\ResponseInterface
     **/
    private function request(string $method, string $path)
    {
        // Clean up uri string
        $path = self::$apiRESTBase . '/' . ltrim($path, '/');

        return $this->client->request($method, $path, [
            'headers' => [
                // 'clientId'         => $this->clientId,
                'Content-Type'     => 'application/json'
            ],
            'allow_redirects' => false
        ]);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function get( string $path )
    {
        return $this->request(self::HTTP_GET, $path);
    }
}
