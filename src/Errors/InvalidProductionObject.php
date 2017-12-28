<?php

namespace Dative\OvationTix\Errors;

class InvalidProductionObject extends Base
{    
    public function __construct() {
        parent::__construct("Object is not a OvationTix production");
    }
}
