<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MachineResource;
use App\Http\Resources\ProductResource;
use App\Models\MachineType;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'article' => ['required', 'string', 'max:255'],
            'actualPrice' => ['required', 'numeric', 'between:0,99999999999.99'],
            'discountPrice' => ['numeric', 'between:0,99999999999.99'],
            'weight' => ['required', 'numeric', 'between:0,999999.99'],
            'width' => ['numeric', 'between:0,999999.99'],
            'height' => ['numeric', 'between:0,999999.99'],
            'length' => ['numeric', 'between:0,999999.99'],
            'hole' => ['string', 'max:320'],
            'previewImage' => ['file'],
        ]);

        $product = new Product();

        if ($request->hasFile('previewImage')) {
            $filename = now() . $request->previewImage->extension();
            $path = $request->previewImage->storeAs('products/preview', $filename, 's3');
        }

        $product->name = $request->name;
        $product->article = $request->article;
        $product->actualPrice = $request->actualPrice;
        $product->discountPrice = $request->discountPrice;
        $product->weight = $request->weight;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->length = $request->length;
        $product->hole = $request->hole;
        $product->previewImage = $path;

        $product->save();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
