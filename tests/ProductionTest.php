<?php

use Dative\OvationTix\OvationTix;
use Dative\OvationTix\Production;
use Dative\OvationTix\Errors\InvalidProductionObject;
use PHPUnit\Framework\TestCase;

class OvationTixTest extends TestCase {

    public function testInvalidProduction()
    {
        $this->expectException(InvalidProductionObject::class);
        $production = new Production( 'notAnObject' );
    }

    public function testValidProduction()
    {
        // Mocked production class
        $obj = new stdClass();
        $obj->productionId = 0;
        $production = new Production( $obj );
        $this->assertTrue( $production instanceof Production );
    }
}