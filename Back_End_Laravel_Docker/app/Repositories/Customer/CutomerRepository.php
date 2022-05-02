<?php

namespace App\Repositories\Customer;

use App\Http\Requests\CustomerFilterRequest;
use http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CutomerRepository implements CustomerRepositoryInterface
{
    public function __construct()
    {
        /*
         * sqlite do not support REGEXP
         * mysql support REGEXP
         * TODO
         * migrate to mysql
         */
        \DB::connection()->getPdo()->sqliteCreateFunction("REGEXP", "preg_match", 2);
    }

    /**
     * Display a listing of customer from dataBase.
     *
     * @param Request $request
     * @return mixed
     */
    public function getCustomers($request)
    {
        if ($request->has('country_code') && $this->_areCountryRecordsExist($request->country_code) == 0) {
            return ['data' => [], 'current_page' => 1,'last_page' => 1];
        }

        $cacheKey = 'customer' . $request->country_code . $request->is_valid . $request->page;

        $customers = Cache::rememberForever($cacheKey, function () use ($request) {
            return $this->_getFilteredQuery($request);
        });

        return $customers;
    }

    /**
     * @param INT $country_code
     */
    private function _areCountryRecordsExist($country_code)
    {
        $cacheKey = 'country' . $country_code;
        $customer = Cache::rememberForever($cacheKey, function () use ($country_code) {
            return DB::table('customer')->where(DB::raw('substr( phone, 2, 3 ) '), '=', $country_code)->first();
        });
        return ($customer !== null) ? 1 : 0;
    }

    /**
     * @param Request $request
     */
    private function _getFilteredQuery($request)
    {
        $customers = DB::table('customer')
            ->leftJoin('country', DB::raw('substr( customer.phone, 2, 3 ) '), '=', 'country.country_code')
            ->select(DB::raw('id, country_name, phone, country_code, REGEXP(country_phonevalidation, phone) as status'))
            ->where(function ($query) use ($request) {
                $this->_filterCountryConditions($query, $request);
                $this->_filterValidOptionConditions($query, $request);
            })
            ->orderBy('id', 'ASC')
            ->paginate(6);
        return $customers;
    }

    /**
     * @param $query
     * @param Request $request
     */
    private function _filterCountryConditions($query, $request)
    {
        if ($request->has('country_code') == 0)
            return;

        $query->where('country_code', $request->country_code);
    }

    /**
     * @param $query
     * @param Request $request
     */
    private function _filterValidOptionConditions($query, $request)
    {
        if ($request->has('is_valid') == 0)
            return;
        if ($request->is_valid === "true")
            $query->whereRaw('REGEXP(country_phonevalidation, phone) not like 0');
        else
            $query->whereRaw('REGEXP(country_phonevalidation, phone) like 0');      //default, is_valid == 'truee'
    }
}
