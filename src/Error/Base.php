<?php

namespace Dative\OvationTix\Error;

use Exception;

abstract class Base extends Exception {

    public function __construct( $message ) {
        parent::__construct($message);
    }
    
}