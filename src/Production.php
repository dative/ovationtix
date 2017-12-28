<?php

namespace Dative\OvationTix;

/**
* Production (OvationTix Series)
*
* @author Rodrigo Passos <rodrigo@hellodative.com>
*/
class Production
{
    // @var int production id
    public $id;

    // @var string production name
    public $name;

    // @var string production status
    public $status;

    // @var int production style
    public $style;

    // @var Venue production venue
    public $venue;

    // @var bool
    public $hasAvailableTickets;

    // @var string
    public $noRemainingMessage;

    // @var int
    public $shutoffHour;

    // @var string
    public $shutoffHourMessage;

    // @var string
    public $superTitle;

    // @var string
    public $subTitle;

    // @var string
    public $purchaseAlert;

    // @var string
    public $description;

    // @var string
    public $logoClientFileId;
    
    // @var string
    public $logoLink;

    // @var string
    public $logoAltName;

    // @var int
    public $departmentId;

    // @var string
    public $departmentName;

    // @var int
    public $firstPerformanceDate;

    // @var int
    public $lastPerformanceDate;

    // @var int
    public $idIfOnlyOneEventAvailable;

    // @var bool
    public $showLinkToBuyTickets;

    // @var GuzzleHttp\Client HTTP client for requests
    private $httpClient;


    /**
     * @param stdClass $production
     * @param Dative\OvationTix\HttpClient $httpClient
     **/
    public function __construct( $production, $httpClient = false )
    {
        if ( property_exists($production, 'productionId') ) {
            $this->id = $production->productionId;
            $this->name = property_exists($production, 'productionName') ? $production->productionName : '';
            $this->status = property_exists($production, 'productionStatus') ? $production->productionStatus : '';
            $this->style = property_exists($production, 'productionStyle') ? $production->productionStyle : 0;
            $this->venue = property_exists($production, 'productionVenue') ? $production->productionVenue : false;
            $this->hasAvailableTickets = property_exists($production, 'hasAvailableTickets') ? $production->hasAvailableTickets : false;
            $this->noRemainingMessage = property_exists($production, 'noRemainingMessage') ? $production->noRemainingMessage : '';
            $this->shutoffHour = property_exists($production, 'shutoffHour') ? $production->shutoffHour : 0;
            $this->shutoffHourMessage = property_exists($production, 'shutoffHourMessage') ? $production->shutoffHourMessage : '';
            $this->superTitle = property_exists($production, 'seriesSuperTitle') ? $production->seriesSuperTitle : '';
            $this->subTitle = property_exists($production, 'seriesSubTitle') ? $production->seriesSubTitle : '';
            $this->purchaseAlert = property_exists($production, 'purchaseAlert') ? $production->purchaseAlert : '';
            $this->description = property_exists($production, 'productionDescription') ? $production->productionDescription : '';
            $this->logoClientFileId = property_exists($production, 'productionLogoClientFileId') ? $production->productionLogoClientFileId : null;
            $this->logoLink = property_exists($production, 'productionLogoLink') ? $production->productionLogoLink : '';
            $this->logoAltName = property_exists($production, 'productionLogoAltName') ? $production->productionLogoAltName : null;
            $this->departmentId = property_exists($production, 'departmentId') ? $production->departmentId : null;
            $this->departmentName = property_exists($production, 'departmentName') ? $production->departmentName : null;
            $this->firstPerformanceDate = property_exists($production, 'firstPerformanceDate') ? $production->firstPerformanceDate : null;
            $this->lastPerformanceDate = property_exists($production, 'lastPerformanceDate') ? $production->lastPerformanceDate : null;
            $this->idIfOnlyOneEventAvailable = property_exists($production, 'performanceIdIfOnlyOneEventAvailable') ? $production->performanceIdIfOnlyOneEventAvailable : null;
            $this->showLinkToBuyTickets = property_exists($production, 'showLinkToBuyTickets') ? $production->showLinkToBuyTickets : false;
        } else {
            throw new Error\InvalidProductionObject();
        }

        $this->httpClient = $httpClient ?: null;
    }

    /**
     * Set HttpClient
     *
     * @param Dative\OvationTix\HttpClient $httpClient
     **/
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    private function hasHttpClient()
    {
        if (!$this->httpClient instanceof HttpClient) {
            throw new Error\HTTPClient("Production Error: this production instance ({$this->id}) doesn't have httpClient set.");
        }
    }

    public function getPerformances()
    {
        $this->hasHttpClient();
        $performances = $this->httpClient->fetchProductionPerformances( $this->id );

        if ( count($performances) ) {
            return array_map(function ($production) {
                return new Production($production, $this->httpClient);
            }, $series);
        }

        return array();
    }
}

