<?php

namespace Dative\OvationTix\Errors;

class ServiceMessage extends Base
{
    public function __construct( $errors ) {
        $messages = '';

        foreach ($errors as $key => $message) {
            $messages .= "Error: " . $message ."\n";
        }
        parent::__construct("OvationTix serviceMessage errors: \n {$messages}");
    }
}
