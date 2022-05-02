<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerFilterRequest;
use App\Repositories\Customer\CustomerRepositoryInterface;


class CustomerController extends Controller
{
    private $_CutomerRepository;

    public function __construct(CustomerRepositoryInterface $CutomerRepository)
    {
        $this->_CutomerRepository = $CutomerRepository;
    }

    /**
     * Create Todo
     * @OA\Post (
     *     path="/api/customers",
     *     tags={"Customer"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="page",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="country_code",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="is_valid",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "page":1,
     *                     "contry_code":212,
     *                     "is_valid":"true",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="string", example="[]"),
     *              @OA\Property(property="current_page", type="number", example=1),
     *              @OA\Property(property="last_page", type="number", example=4),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function index(CustomerFilterRequest $request)
    {
        $customers = $this->_CutomerRepository->getCustomers($request);

        return response()->json($customers, 200);
    }

}
