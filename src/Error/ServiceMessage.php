<?php

namespace Dative\OvationTix\Error;

class ServiceMessage extends Base
{
    public function __construct( $message ) {
        parent::__construct("OvationTix serviceMessage error: {$message}");
    }
}
