<?php

namespace App\Http\Filters;

use App\Models\ProductForCategory;
use Illuminate\Database\Eloquent\Builder;

class ProductForCategoryFilter extends QueryFilter
{
    /**
     * @param string $categoryId
     */
    public function category(string $categoryId)
    {
        // $this->builder->where('category', function ($query) use ($categoryId) {
        //     $query->where('id', $categoryId);
        // })->take(10);

        // $this->builder->with('category')->whereHas('category', function ($query) use ($categoryId) {
        //     $query->where('id', $categoryId);
        // })->take(10);
        // $this->builder->with('category')->leftJoin('product_for_categories', function ($query) use ($categoryId) {
        //     $query->on('product_category_id', $categoryId);
        // })
        //     ->take(10);
        //$this->builder->with('category')->where('caregory.id', $categoryId)->take(10);
    }
}
