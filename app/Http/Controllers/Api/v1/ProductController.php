<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\MachineForProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductForCategory;
use App\Models\ProductProperties;
use App\Models\UploadImage;
use App\Http\Filters\ProductFilter;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'properties' => ['required'],
            'article' => ['required', 'string', 'max:255'],
            'actualPrice' => ['nullable', 'between:0,99999999999.99'],
            'discountPrice' => ['nullable', 'between:0,99999999999.99'],
            'description' => ['string', 'nullable'],
            'brandId' => ['numeric'],
            'typeId' => ['numeric'],
            'categoryId' => ['numeric'],
            'machines' => ['string'],
            'images' => ['array'],
        ]);

        $product = new Product;
        $host = $request->getSchemeAndHttpHost();

        $product->name = $request->name;
        $product->article = $request->article;
        $product->actualPrice = $request->actualPrice;
        $product->discountPrice = $request->discountPrice;
        $product->description = $request->description;
        $product->brandId = $request->brandId;
        $product->typeId = $request->typeId;

        $product->save();

        $images = $request->images;
        if ($images) {
            foreach ($images as $image) {
                $imageName = uniqid() . '.webp';

                $uploadImage = new UploadImage();
                $uploadImage->name = $imageName;
                $uploadImage->url = $host . '/storage/' . $uploadImage->upload($image, 'public', 'products/images', $imageName);

                $product->images()->save($uploadImage);
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

        $properties = json_decode($request->properties);
        foreach ($properties as $property) {
            $productProp = new ProductProperties;

            if ($property->isDimension) {
                $productProp->isDimension = $property->isDimension;
                $productProp->dimension = $property->dimension;
            }

            $productProp->value = $property->value;
            $productProp->propertiesId = $property->property->id;

            $product->properties()->save($productProp);
        }

        // Category
        $category = ProductCategory::find($request->categoryId);
        $productForCategory = new ProductForCategory;
        $productForCategory->product_category_id = $category->id;
        $product->category()->save($productForCategory);

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
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
