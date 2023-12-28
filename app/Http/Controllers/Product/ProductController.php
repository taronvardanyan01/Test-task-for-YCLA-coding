<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/product",
     *     tags={"Product"},
     *     summary="Get a list of products",
     *     description="Returns a list of products. The list can be filtered by a search term.",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term to filter the list of products",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number to paginate the list of products",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             minimum=1
     *     )
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *      security={
     *          {"Authorization Token": {}}
     *      }
     * )
     */

    public function __invoke(
        ProductRequest $productRequest,
        ProductAction $productAction
    ): AnonymousResourceCollection {
        $products = $productAction->run($productRequest->getSearch(), $productRequest->getPage());

        return ProductResource::collection($products);
    }
}
