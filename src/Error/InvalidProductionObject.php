<?php

namespace Dative\OvationTix\Error;

class InvalidProductionObject extends Base
{    
    public function __construct() {
        parent::__construct("Object is not a OvationTix production");
    }
}
