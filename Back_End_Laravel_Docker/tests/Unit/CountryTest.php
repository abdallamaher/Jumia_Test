<?php


use Tests\TestCase;
use Tests\Traits\HttpTrait;

class CountryTest extends TestCase
{
    use HttpTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_countries_data()
    {
        $response = $this->doGet('api/public/countries');

        $response->assertStatus(200);
    }
}
