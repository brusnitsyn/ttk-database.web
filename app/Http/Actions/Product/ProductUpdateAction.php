<?php

namespace App\Actions\Product;

use App\Models\MachineForProduct;
use App\Models\Product;
use App\Models\ProductForCategory;
use App\Models\ProductProperties;
use App\Models\UploadImage;
use Illuminate\Http\Request;

class ProductUpdateAction
{
    public function handle(Product $product, Request $request)
    {
        // $brand = json_decode($request->brand);
        // $type = json_decode($request->type);
        // $category = json_decode($request->category);

        // $host = $request->getSchemeAndHttpHost();

        // $product->name = $request->name;
        // $product->article = $request->article;
        // $product->actualPrice = $request->actualPrice;
        // $product->discountPrice = $request->discountPrice;
        // $product->description = $request->description;
        // $product->brandId = $brand->id;
        // $product->typeId = $type->id;

        // $product->save();

        // // Category
        // if ($category != null) {
        //     $productForCategory = new ProductForCategory;
        //     $productForCategory->product_category_id = $category->id;
        //     $product->category()->save($productForCategory);
        // }


        // // Images
        // $images = $request->images;
        // if ($images) {
        //     // if($product->images()) {

        //     // }
        //     foreach ($images as $image) {
        //         $imageName = uniqid() . '.webp';

        //         $uploadImage = new UploadImage();
        //         $uploadImage->name = $imageName;
        //         $uploadImage->url = $host . '/api/storage/' . $uploadImage->upload($image, 'public', 'products/images', $imageName);

        //         $product->images()->save($uploadImage);
        //     }
        // }

        // // Machines
        // $machines = json_decode($request->machines);
        // if ($machines) {
        //     foreach ($machines as $machine) {

        //         $productMachine = MachineForProduct::where('product_id', $product->id)->firstOrFail();

        //         if ($productMachine)
        //             $productMachine->delete();

        //         $machineForProduct = new MachineForProduct();
        //         $machineForProduct->productId = $product->id;
        //         $machineForProduct->machineId = $machine->id;
        //         $machineForProduct->save();
        //     }
        // }

        // // Properties
        // $properties = json_decode($request->properties);
        // foreach ($product->properties() as $productProp) {
        //     $id = $productProp->id;
        //     foreach ($properties as $property) {
        //         $prop = ProductProperties::where('id', $id)->first();
        //         $prop = ProductProperties::updateOrCreate([
        //             'isDimension' => $property->isDimension,
        //             'dimension' => $property->dimension,
        //             'value' => $property->value,
        //             'propertiesId' => $property->propertiesId,
        //         ]);
        //         $product->properties()->save($prop);
        //     }
        // }
        //////////////////////
        $host = $request->getSchemeAndHttpHost();

        $product->name = $request->name;
        $product->article = $request->article;
        $product->actualPrice = $request->actualPrice;
        $product->discountPrice = $request->discountPrice;
        $product->description = $request->description;
        $product->brandId = $request->brandId;
        $product->typeId = $request->typeId;

        $product->save();

        // Category
        $productForCategory = new ProductForCategory;
        $productForCategory->product_category_id = $request->categoryId;
        $product->category()->save($productForCategory);

        // Machines
        if ($request->machinesIds) {
            foreach ($request->machinesIds as $machineId) {
                $machineForProduct = new MachineForProduct;
                $machineForProduct->productId = $product->id;
                $machineForProduct->machineId = $machineId;
                $machineForProduct->save();
            }
        }

        // Properties
        if ($request->properties) {
            foreach ($request->properties as $property) {
                $productProp = new ProductProperties;

                if ($property->isDimension) {
                    $productProp->isDimension = $property->isDimension;
                    $productProp->dimension = $property->dimension;
                }

                $productProp->value = $property->value;
                $productProp->propertiesId = $property->property->id;

                $product->properties()->save($productProp);
            }
        }

        // Images
        if ($request->images) {
            foreach ($request->images as $image) {
                $imageName = uniqid() . '.webp';

                $uploadImage = new UploadImage;
                $uploadImage->name = $imageName;
                $uploadImage->url = $host . '/storage/' . $uploadImage->upload($image, 'public', 'products/images', $imageName);

                $product->images()->save($uploadImage);
            }
        }

        return $product;
    }
}
