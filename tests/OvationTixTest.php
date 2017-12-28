<?php

use Dative\OvationTix\OvationTix;
use PHPUnit\Framework\TestCase;

class OvationTixTest extends TestCase {
    
    protected $otix;
    
    protected function setUp()
    {
        // clientId 284 is the test client on the API docs.
        $this->otix = new OvationTix(284);
    }
    
    public function testOvationTixPingAPIEndPoint()
    {
        $this->assertTrue( $this->otix->ping() );
    }

    public function testOvationTixGetSeries()
    {
        $series = $this->otix->getSeries();

        // is it type of array?
        $this->assertInternalType('array', $series);

        // array has more tha 0 items in it?
        $this->assertTrue( count($series) > 0);
    }
    
}