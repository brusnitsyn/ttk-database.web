<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class MachineTypeFilter extends QueryFilter
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
     * @param string $brandId
     */
    public function brand(string $brandId)
    {
        $this->builder->with('brand')->whereHas('brand', function ($query) use ($brandId) {
            $query->where('id', $brandId);
        })->take(10);
    }
}
