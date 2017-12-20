<?php

namespace Dative\OvationTix\Error;

class InactiveOvationtixClient extends Base
{    
    public function __construct( $clientId ) {
        parent::__construct("OvationTix clientId {$clientId} is not active.");
    }
}
