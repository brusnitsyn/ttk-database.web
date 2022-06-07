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
            'brand' => ['string'],
            'type' => ['string'],
            'category' => ['string'],
            'machines' => ['string'],
            'images' => ['array'],
        ]);

        $product = new Product;
        $host = $request->getSchemeAndHttpHost();

        $brand = json_decode($request->brand);
        $type = json_decode($request->type);
        $category = json_decode($request->category);

        $product->name = $request->name;
        $product->article = $request->article;
        $product->actualPrice = $request->actualPrice;
        $product->discountPrice = $request->discountPrice;
        $product->description = $request->description;
        $product->brandId = $brand->id;
        $product->typeId = $type->id;

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
        $category = ProductCategory::find($category->id);
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
    public function update(Request $request, Product $product)
    {
        $brand = json_decode($request->brand);
        $type = json_decode($request->type);
        $category = json_decode($request->category);

        $host = $request->getSchemeAndHttpHost();

        $product->name = $request->name;
        $product->article = $request->article;
        $product->actualPrice = $request->actualPrice;
        $product->discountPrice = $request->discountPrice;
        $product->description = $request->description;
        $product->brandId = $brand->id;
        $product->typeId = $type->id;

        $product->save();

        $images = $request->images;
        if ($images) {
            // if($product->images()) {

            // }
            foreach ($images as $image) {
                $imageName = uniqid() . '.webp';

                $uploadImage = new UploadImage();
                $uploadImage->name = $imageName;
                $uploadImage->url = $host . '/api/storage/' . $uploadImage->upload($image, 'public', 'products/images', $imageName);

                $product->images()->save($uploadImage);
            }
        }

        $machines = json_decode($request->machines);
        if ($machines) {
            foreach ($machines as $machine) {

                $productMachine = MachineForProduct::where('product_id', $product->id)->firstOrFail();

                if ($productMachine)
                    $productMachine->delete();

                $machineForProduct = new MachineForProduct();
                $machineForProduct->productId = $product->id;
                $machineForProduct->machineId = $machine->id;
                $machineForProduct->save();
            }
        }

        $properties = json_decode($request->properties);
        foreach ($product->properties() as $productProp) {
            $id = $productProp->id;
            foreach ($properties as $property) {
                $prop = ProductProperties::where('id', $id)->first();
                $prop = ProductProperties::updateOrCreate([
                    'isDimension' => $property->isDimension,
                    'dimension' => $property->dimension,
                    'value' => $property->value,
                    'propertiesId' => $property->propertiesId,
                ]);
                $product->properties()->save($prop);
            }
        }
        // $productProps = $product->properties();
        // if ($productProps) {
        //     foreach ($productProps as $prop) {

        //         else {
        //             $productProp = new ProductProperties;
        //             if ($property->isDimension) {
        //                 $productProp->isDimension = $property->isDimension;
        //                 $productProp->dimension = $property->dimension;
        //             }

        //             $productProp->value = $property->value;
        //             $productProp->propertiesId = $property->property->id;
        //             $product->properties()->save($productProp);
        //         }
        //     }
        // } else {
        //     $productProp = new ProductProperties;
        //     if ($property->isDimension) {
        //         $productProp->isDimension = $property->isDimension;
        //         $productProp->dimension = $property->dimension;
        //     }

        //     $productProp->value = $property->value;
        //     $productProp->propertiesId = $property->property->id;
        //     $product->properties()->save($productProp);
        // }

        // Category
        if ($category != null) {
            $category = ProductCategory::find($category->id);
            $productForCategory = new ProductForCategory;
            $productForCategory->product_category_id = $category->id;
            $product->category()->save($productForCategory);
        }

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
