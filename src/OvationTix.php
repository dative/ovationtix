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

    // @var HttpClient
    public $httpClient;

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
            $this->httpClient = new HttpClient($clientId);
        } else {
            $message = "clientId is required.";
            throw new Error\HTTPClient($message);
        }
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
        $series = $this->httpClient->fetchSeries();

        if ( count($series) ) {
            return array_map(function ($production) {
                return new Production($production, $this->httpClient);
            }, $series);
        }

        return array();
    }

    /**
     * Get series production
     *
     * @param int $productionId
     * @return OvationTix\Production
     **/
    public function getSeriesProduction( int $productionId )
    {
        $production = $this->httpClient->fetchSeriesProduction( $productionId );
        return new Production($production, $this->httpClient);
    }
}