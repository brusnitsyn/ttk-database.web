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
        $words = array_filter(explode(' ', $name));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('name', 'like', "%$word%");
            }
        });
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
     * @param string $brandId
     */
    public function brand(string $brandId)
    {
        $this->builder->with('brand')->whereHas('brand', function ($query) use ($brandId) {
            $query->where('id', $brandId);
        });
    }

    /**
     * @param string $typeId
     */
    public function type(string $typeId)
    {
        $this->builder->where('type_id', $typeId);
    }
}
