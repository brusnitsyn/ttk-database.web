<?php

namespace App\Http\Filters;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductForCategory;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends QueryFilter
{
    /**
     * @param string $name
     */
    public function search(string $name)
    {
        if (isset($name)) {
            $words = array_filter(explode(' ', $name));

            $this->builder->where(function (Builder $query) use ($words) {
                foreach ($words as $word) {
                    $query->where('name', 'like', "%$word%");
                }
            });
        }
    }

    /**
     * @param string $categoryId
     */
    public function category(string $categoryId)
    {
        $this->builder->whereHas('category', function ($query) use ($categoryId) {
            $query->where('product_for_categories.product_category_id', $categoryId);
        });
    }

    /**
     * @param string $brandsIds
     */
    public function brand(string $brandsIds)
    {
        return $this->builder->whereIn('brand_id', $this->paramToArray($brandsIds));
        // $brands = explode(' ,', $brandsId);
        // $this->builder->with('brand')->whereHas('brand', function ($query) use ($brands) {
        //     foreach ($brands as $brand) {
        //         $query->where('id', 'like', $brand);
        //     }
        // });
    }

    /**
     * @param string $typesIds
     */
    public function type(string $typesIds)
    {
        return $this->builder->whereIn('type_id', $this->paramToArray($typesIds));
        //$this->builder->where('type_id', $typeId);
    }
}
