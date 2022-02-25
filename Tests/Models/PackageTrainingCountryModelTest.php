<?php

use ProcessMaker\Package\PackageTraining\Models\PackageCountry;
use Tests\TestCase;
use Illuminate\Http\Request;

class PackageTrainingCountryModelTest extends TestCase
{
    function __construct()
    {
        parent::__construct();
        Artisan::call("package-training:install");
    }
    function testName()
    {
        // $this->markTestSkipped('Incomplete Test working on the test');
        $boolean = true;

        $asdasd = '';
        $this->assertTrue($boolean);
    }

    function testStoreCountry()
    {
        $data = [
            'country' => 'Mexico',
            'region' => 'sudamerica',
            'country_id' => 'MX',
            'status' => 'ENABLED'
        ];

        $storeCountry = PackageCountry::store(new Request($data));

        $this->assertEquals($data['country'], $storeCountry->country);
        $this->assertEquals($data['region'], $storeCountry->region);
        $this->assertInstanceOf(PackageCountry::class, $storeCountry);
    }
}
