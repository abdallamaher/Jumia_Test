<?php


use Tests\TestCase;
use Tests\Traits\HttpTrait;

class CustomerTest extends TestCase
{
    use HttpTrait;


    public function test_can_retrieve_customers_data_success()
    {
        $formData = [

        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_success_when_is_valid_true()
    {
        $formData = [
            'is_valid'      => 'true'
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_success_when_is_valid_false()
    {
        $formData = [
            'is_valid'      => 'false'
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_success_with_page()
    {
        $formData = [
            'page'          => 2,
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_success_with_country_code()
    {
        $formData = [
            'country_code'  => 212,
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_success_with_page_country()
    {
        $formData = [
            'page'          => 2,
            'country_code'  => 212,
            'is_valid'      => 'true'
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_success_page_country_code_is_valid()
    {
        $formData = [
            'page'          => 1,
            'country_code'  => 212,
            'is_valid'      => 'false'
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(200);
    }

    public function test_customer_validation_request_failed_as_page_is_string()
    {
        $formData = [
            'page'          => '2r',
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(422);
    }

    public function test_customer_validation_request_failed_as_country_code_is_string()
    {
        $formData = [
            'country_code'  => '212r',
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(422);
    }

    public function test_customer_validation_request_failed_as_is_valid_length_is_long()
    {
        $formData = [
            'is_valid'      => 'trueeee'
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(422);
    }

    public function test_customer_validation_request_failed_as_is_valid_length_is_short()
    {
        $formData = [
            'is_valid'      => ''
        ];
        $response = $this->doPost('api/customers', $formData);

        $response->assertStatus(422);
    }
}
