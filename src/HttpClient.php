<?php

namespace Dative\OvationTix;

use Dative\OvationTix\Errors\HTTPClientProductionNotFound;
use Dative\OvationTix\Errors\InactiveOvationtixClient;
use Dative\OvationTix\Errors\ServiceMessage;
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

        $response = $this->client->request($method, $path, [
            'headers' => [
                // 'clientId'         => $this->clientId,
                'Content-Type'     => 'application/json'
            ],
            'allow_redirects' => false
        ]);

        $jsonObj = json_decode( (string) $response->getBody() );
        
        $this->validateRequest($jsonObj);

        return $jsonObj;
    }

    /**
    * Fetch series productions
    *
    * Returns a array of objects
    *
    * @return array
    **/
    public function fetchSeries()
    {
        $response = $this->request(
            self::HTTP_GET, 
            "/series/client({$this->clientId})"
        );
        return $response->seriesInformation;
    }

    /**
     * Fetch series production
     *
     * @param int $productionId
     * @return \stdClass
     * @throws HTTPClientProductionNotFound
     **/
    public function fetchSeriesProduction( int $productionId )
    {
        $response = $this->request(
            self::HTTP_GET, 
            "/series/client({$this->clientId})/production({$productionId})"
        );

        if ( count($response->seriesInformation) === 0 ) {
            throw new HTTPClientProductionNotFound($productionId);
        }
        return $response->seriesInformation[0];
    }

    /**
     * Fetch series production
     *
     * @param int $productionId
     * @return \stdClass
     **/
    public function fetchProductionPerformances( int $productionId )
    {
        $response = $this->request(
            self::HTTP_GET, 
            "/events/client({$this->clientId})/production({$productionId})"
        );
        return $response->performances;
    }

    /**
     * Validate api request
     *
     * @param \stdClass $obj
     **/
    private function validateRequest( $obj ) 
    {
        $this->checkErrors($obj->serviceMessages->errors);
        $this->isClientActive($obj->clientActive);
    }

    /**
     * Check if client is active
     *
     * @param bool $isActive
     * @throws InactiveOvationtixClient
     **/
    private function isClientActive( $isActive ) 
    {
        if ( ! $isActive ) {
            throw new InactiveOvationtixClient($this->clientId);
        }
    }

    /**
     * Check for errors
     *
     * @param array $errors
     * @throws ServiceMessage
     **/
    private function checkErrors( array $errors ) 
    {
        if ( count($errors) ) {
            throw new ServiceMessage($errors);
        }
    }
}
