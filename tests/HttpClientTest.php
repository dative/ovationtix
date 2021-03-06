<?php

use Dative\OvationTix\HttpClient;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase {
    
    protected $client;
    
    protected function setUp()
    {
        // clientId 284 is the test client on the API docs.
        $this->client = new HttpClient(284);
    }

    public function testOvationTixFetchSeries()
    {
        $series = $this->client->fetchSeries();

        // is it type of array?
        $this->assertInternalType('array', $series);

        // array has more tha 0 items in it?
        $this->assertTrue( count($series) > 0);
    }

    public function testOvationTixFetchSeriesProduction()
    {
        $production = $this->client->fetchSeriesProduction(955932);
        $this->assertTrue( property_exists($production, 'productionId') );
    }
    
}