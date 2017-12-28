<?php

namespace Dative\OvationTix;

use Dative\OvationTix\Errors\InvalidPerformanceObject;
use Dative\OvationTix\Traits\UseHttpClient;

/**
 * Performance class
 * 
 * OvationTix Series Production performance
 */
class Performance
{
    public $id;
    public $start;
    public $date;
    public $time;
    public $mtime;
    public $startDate;
    public $superTitle;
    public $subTitle;
    public $notes;
    public $availabilityCode;
    public $displayCode;
    public $productionId;
    public $productionName;
    public $hasAvailableTickets;
    public $tixRemaining;
    public $customMessage;
    public $noRemainingTicketsMessage;
    public $shutoffHour;
    public $shutoffHourMessage;
    public $generalAdmission;
    public $allDayEvent;
    public $productionLogoLink;
    public $productionDescription;
    public $departmentId;
    public $departmentName;
    public $entryTimes;

    /**
     * @param stdClass $performance
     * @param Dative\OvationTix\HttpClient $httpClient
     **/
    public function __construct( $performance )
    {
        if ( property_exists($performance, 'performanceId') ) {
            $this->id = $performance->performanceId;
            $this->start = property_exists($performance, 'start') ? $performance->performanceStart : 0;
            $this->date = property_exists($performance, 'date') ? $performance->performanceDate : '';
            $this->time = property_exists($performance, 'time') ? $performance->performanceTime : '';
            $this->mtime = property_exists($performance, 'mtime') ? $performance->performanceTime24 : '';
            $this->startDate = property_exists($performance, 'startDate') ? $performance->performanceStartDate : '';
            $this->superTitle = property_exists($performance, 'superTitle') ? $performance->performanceSuperTitle : '';
            $this->subTitle = property_exists($performance, 'subTitle') ? $performance->performanceSubTitle : '';
            $this->notes = property_exists($performance, 'notes') ? $performance->performanceNotes : '';
            $this->availabilityCode = property_exists($performance, 'availabilityCode') ? $performance->availabilityCode : '';
            $this->displayCode = property_exists($performance, 'displayCode') ? $performance->displayCode : '';
            $this->productionId = property_exists($performance, 'productionId') ? $performance->productionId : 0;
            $this->productionName = property_exists($performance, 'productionName') ? $performance->productionName : '';
            $this->hasAvailableTickets = property_exists($performance, 'hasAvailableTickets') ? $performance->hasAvailableTickets : false;
            $this->tixRemaining = property_exists($performance, 'tixRemaining') ? $performance->tixRemaining : 0;
            $this->customMessage = property_exists($performance, 'customMessage') ? $performance->customMessage : '';
            $this->noRemainingTicketsMessage = property_exists($performance, 'noRemainingTicketsMessage') ? $performance->noRemainingTicketsMessage : null;
            $this->shutoffHour = property_exists($performance, 'shutoffHour') ? $performance->shutoffHour : 0;
            $this->shutoffHourMessage = property_exists($performance, 'shutoffHourMessage') ? $performance->shutoffHourMessage : '';
            $this->generalAdmission = property_exists($performance, 'generalAdmission') ? $performance->generalAdmission : false;
            $this->allDayEvent = property_exists($performance, 'allDayEvent') ? $performance->allDayEvent : false;
            $this->productionLogoLink = property_exists($performance, 'productionLogoLink') ? $performance->productionLogoLink : '';
            $this->productionDescription = property_exists($performance, 'productionDescription') ? $performance->productionDescription : '';
            $this->departmentId = property_exists($performance, 'departmentId') ? $performance->departmentId : null;
            $this->departmentName = property_exists($performance, 'departmentName') ? $performance->departmentName : null;
            $this->entryTimes = property_exists($performance, 'entryTimes') ? $performance->entryTimes : array();
        } else {
            throw new InvalidPerformanceObject();
        }
    }
}
