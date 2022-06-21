<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Product\ProductStoreAction;
use App\Actions\Product\ProductUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\MachineForProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductForCategory;
use App\Models\ProductProperties;
use App\Models\UploadImage;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilter $filter)
    {
        $products = Product::filter($filter)->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request, ProductStoreAction $action)
    {
        $product = $action->handle($request);
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, ProductUpdateAction $action)
    {
        $product = $action->handle($product, $request);
        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
