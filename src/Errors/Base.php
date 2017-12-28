<?php

namespace Dative\OvationTix\Errors;

use Exception;

abstract class Base extends Exception {

    public function __construct( $message ) {
        parent::__construct($message);
    }
    
}