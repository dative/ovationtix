<?php

namespace Dative\OvationTix;

/**
* Production (OvationTix Series)
*
* @author Rodrigo Passos <rodrigo@hellodative.com>
*/
class Production
{
    /**
     * @param stdClass $production
     **/
    public function __construct( $production )
    {
        if ( property_exists($production, 'productionId') ) {
            
        } else {
            throw new Error\InvalidProductionObject();
        }
    }    
}

