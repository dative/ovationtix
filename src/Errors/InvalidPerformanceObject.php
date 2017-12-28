<?php

namespace Dative\OvationTix\Errors;

class InvalidPerformanceObject extends Base
{    
    public function __construct() {
        parent::__construct("Object is not a OvationTix performance");
    }
}
