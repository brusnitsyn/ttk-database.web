<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MachineResource;
use App\Http\Resources\ProductResource;
use App\Models\MachineForProduct;
use App\Models\MachineType;
use App\Models\Product;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'originalArticle' => ['nullable', 'string', 'max:255'],
            'actualPrice' => ['nullable', 'numeric', 'between:0,99999999999.99'],
            'discountPrice' => ['nullable', 'between:0,99999999999.99'],
            'weight' => ['required', 'numeric', 'between:0,999999.99'],
            'width' => ['numeric', 'between:0,999999.99', 'nullable'],
            'diameter' => ['nullable', 'numeric', 'between:0,999999.99'],
            'thickness' => ['nullable', 'numeric', 'between:0,999999.99'],
            'height' => ['numeric', 'between:0,999999.99', 'nullable'],
            'length' => ['numeric', 'between:0,999999.99', 'nullable'],
            'hole' => ['string', 'max:320', 'nullable'],
            'mountingHole' => ['string', 'max:320', 'nullable'],
            'captureWidth' => ['string', 'max:320', 'nullable'],
            'thread' => ['string', 'max:320', 'nullable'],
            'distanceBetweenHoles' => ['string', 'max:320', 'nullable'],
            'description' => ['string', 'nullable'],
            'brandId' => ['numeric'],
            'machines' => ['required'],
            'previewImage' => ['image'],
            'carouselImages' => ['required'],
            'carouselImages.*' => ['required']
        ]);

        $product = new Product;

        if ($request->hasFile('previewImage')) {
            $path = $product->upload($request->previewImage, 'public', 'products/preview');
        }

        $product->name = $request->name;
        $product->article = $request->article;
        $product->originalArticle = $request->originalArticle;
        $product->actualPrice = $request->actualPrice;
        $product->discountPrice = $request->discountPrice;
        $product->weight = $request->weight;
        $product->width = $request->width;
        $product->diameter = $request->diameter;
        $product->thickness = $request->thickness;
        $product->height = $request->height;
        $product->length = $request->length;
        $product->hole = $request->hole;
        $product->mountingHole = $request->mountingHole;
        $product->captureWidth = $request->captureWidth;
        $product->thread = $request->thread;
        $product->distanceBetweenHoles = $request->distanceBetweenHoles;
        $product->description = $request->description;
        $product->previewImage = $path;
        $product->brandId = $request->brandId;

        $product->save();

        $carouselImages = $request->carouselImages;
        if (count($carouselImages) > 0) {
            foreach ($carouselImages as $image) {
                $imageName = uniqid() . '_' . str_replace(' ', '_', $image->getClientOriginalName());

                $uploadImage = new UploadImage();
                $uploadImage->name = $imageName;
                $uploadImage->url = $uploadImage->upload($image, 'public', 'products/carousel');

                $product->carouselImages()->save($uploadImage);
            }
        }

        $machines = json_decode($request->machines);
        if ($machines) {
            foreach ($machines as $machine) {
                $machineForProduct = new MachineForProduct();
                $machineForProduct->productId = $product->id;
                $machineForProduct->machineId = $machine->id;
                $machineForProduct->save();
            }
        }

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
