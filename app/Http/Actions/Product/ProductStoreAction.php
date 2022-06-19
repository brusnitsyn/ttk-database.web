<?php

namespace App\Actions\Product;

use App\Models\MachineForProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductForCategory;
use App\Models\ProductProperties;
use App\Models\UploadImage;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreAction
{
    public function handle(FormRequest $request)
    {
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
    }
}
