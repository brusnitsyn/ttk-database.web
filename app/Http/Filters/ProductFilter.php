<?php

namespace App\Http\Filters;

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
        $this->builder->with('category')->whereHas('category', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        })->take(10);
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
        $this->builder->with('type')->whereHas('type', function ($query) use ($typeId) {
            $query->where('id', $typeId);
        });
    }
}
