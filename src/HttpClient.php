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

    // @var int OvationTix client id
    private $clientId;

    const HTTP_GET  = 'GET';
    const HTTP_POST = 'POST';

    // @var GuzzleHttp\Client HTTP client for requests
    private $client;

    public function __construct( $clientId )
    {
        $this->clientId = $clientId;
        $this->client = new \GuzzleHttp\Client();
    }

    /**
    * Check if OvationTix REST API is online
    *
    * @return bool
    * @throws conditon
    **/
    public function ping()
    {
        $response = $this->request(self::HTTP_GET, '/');
        return $response->getStatusCode() === 200;
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
    * Get series productions
    *
    * Returns a array of objects
    *
    * @return array
    * @throws Error\InactiveOvationtixClient
    **/
    public function getSeries()
    {
        $response = $this->request(self::HTTP_GET, "/series/client({$this->clientId})");
        $jsonObj = json_decode( (string) $response->getBody() );

        if ( count($jsonObj->serviceMessages->errors) ) {
            throw new Error\ServiceMessage($message);
        }

        if ( $jsonObj->clientActive ) {

            return $jsonObj->seriesInformation;

        } else {
            throw new Error\InactiveOvationtixClient($this->clientId);
        }
        
        return false;
    }
}
