<?php
/**
* @link      https://hellodative.com/
* @copyright Copyright (c) Dative, Inc.
* @license   MIT
*/

namespace Dative\OvationTix;

/**
* OvationTix is a helper class that facilitates access to the OvationTix API
*
* @author Rodrigo Passos <rodrigo@hellodative.com>
*/
class OvationTix
{
    
    
    // @var int OvationTix client id
    public $clientId;

    const VERSION = '1.0.0';

    /**
     * Sets OvationTix client's id to be used for requests.
     *
     * @param int $clientId Description
     * @throws Error\HTTPClient
     **/
    public function __construct(int $clientId = null)
    {
        if ($clientId) {
            $this->clientId = $clientId;
            $this->httpClient = new HttpClient();
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
        $response = $this->httpClient->get('/');
        return $response->getStatusCode() === 200;
    }
    
    /**
    * Get series productions
    *
    * Returns a array of productions
    *
    * @return array
    * @throws Error\InactiveOvationtixClient
    **/
    public function getSeries()
    {
        $response = $this->httpClient->get("/series/client({$this->clientId})");
        $jsonObj = json_decode( (string) $response->getBody() );

        if ( count($jsonObj->serviceMessages->errors) ) {
            throw new Error\ServiceMessage($message);
        }

        if ( $jsonObj->clientActive ) {

            return array_map(function ($production) {
                return new Production($production);
            }, $jsonObj->seriesInformation);

        } else {
            throw new Error\InactiveOvationtixClient($this->clientId);
        }
        return false;
    }
}