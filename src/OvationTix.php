<?php
/**
* @link      https://hellodative.com/
* @copyright Copyright (c) Dative, Inc.
* @license   MIT
*/

namespace Dative\OvationTix;

use GuzzleHttp\Client;

/**
* OvationTix is a helper class that facilitates access to the OvationTix API
*
* @author Rodrigo Passos <rodrigo@hellodative.com>
*/
class OvationTix
{
    // @var string The base URL for the OvationTix REST API.
    private static $apiRESTBase = "https://api.ovationtix.com/public/";
    
    // @var int OvationTix client id
    public $clientId;

    // @var GuzzleHttp\Client HTTP client for requests
    private $httpClient;

    const VERSION = '1.0.0';

    const HTTP_GET  = 'GET';
    const HTTP_POST = 'POST';

    /**
     * Sets OvationTix client's id to be used for requests.
     *
     * @param int $clientId Description
     * @return type
     * @throws conditon
     **/
    public function __construct(int $clientId = null)
    {
        if ($clientId) {
            $this->clientId = $clientId;
            $this->httpClient = new \GuzzleHttp\Client();
        } else {
            $message = "clientId is required.";
            throw new Error\HTTPClient($message);
        }
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
     * Undocumented function long description
     *
     * @param string $method
     * @param string $path
     * @return Psr\Http\Message\ResponseInterface
     **/
    private function request(string $method, string $path)
    {
        $path = self::$apiRESTBase . '/' . ltrim($path, '/');
        return $this->httpClient->request($method, $path, [
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
    * Returns a array of productions
    *
    * @return array
    **/
    public function getSeries()
    {
        $response = $this->request(self::HTTP_GET, "/series/client({$this->clientId})");
        return [];
    }
}