<?php

namespace Dative\OvationTix\Errors;

class HTTPClientProductionNotFound extends Base
{
    public function __construct( $productionId ) {
        parent::__construct("HTTPClient Error: Production with id {$productionId} not found.");
    }
}
