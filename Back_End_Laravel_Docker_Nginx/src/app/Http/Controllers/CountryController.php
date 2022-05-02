<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use http\Client\Response;
use App\Models\Country;


class CountryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/public/countries",
     *     tags={"Public"},
     *     description="retrieve countries data",
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */
    public function index()
    {
        $countries = Country::get(['country_code', 'country_name']);
        return new CountryResource($countries);
    }
}
