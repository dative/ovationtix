<?php

use Dative\OvationTix\OvationTix;
use PHPUnit\Framework\TestCase;

class OvationTixTest extends TestCase {
    
    protected $otix;
    
    protected function setUp()
    {
        $this->otix = new OvationTix(284);
    }
    
    public function testOvationTixPingAPIEndPoint()
    {
        $this->assertTrue( $this->otix->ping() );
    }

    public function testOvationTixGetSeries()
    {
        $this->assertInternalType('array', $this->otix->getSeries());
    }
    
}