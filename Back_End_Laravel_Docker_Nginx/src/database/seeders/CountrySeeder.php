<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * TODO:: make countries seeder
         */
        $countries = [
            [country_code => 212 ,country_name => 'Morocco', country_phonevalidation => '/\(212\)\ ?[5-9]\d{8}$/'],
            [country_code => 258 ,country_name => 'Mozambique', country_phonevalidation  =>  '/\(258\)\ ?[28]\d{7,8}$/'],
            [country_code => 234 ,country_name => 'Nigeria', country_phonevalidation  =>  '/\(234)\ ^[0]\d{10}$/'],
            [country_code => 256 ,country_name => 'Uganda', country_phonevalidation  =>  '/\(256\)\ ?\d{9}$/'],
            [country_code => 251 ,country_name => 'Ethiopia', country_phonevalidation  =>  '/\(251\)\ ?[1-59]\d{8}$/'],
            [country_code => 237 ,country_name => 'Cameroon', country_phonevalidation  =>  '/\(237\)\ ?[2368]\d{7,8}$/'],
        ];
        foreach ($countries as $country) {
            DB::table('country')->insert([
                'country_code'              => $country.country_code,
                'country_name'              => $country.country_name,
                'country_phonevalidation'   => $country.country_phonevalidation,
            ]);
        }
    }
}
