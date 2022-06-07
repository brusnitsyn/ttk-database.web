<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Traits\Eloquent\Uploadable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Product extends BaseModel
{
    use HasFactory, Uploadable;

    protected $fillable = [
        'name',
        'article',
        'actual_price',
        'discount_price',
        'brand_id',
    ];

    /**
     * Get the brand that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the type that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(MachineType::class);
    }

    /**
     * The machines that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function machines()
    {
        return $this->belongsToMany(Machine::class, 'machine_for_products', 'product_id', 'machine_id');
    }

    public function category()
    {
        //return $this->belongsToMany(ProductForCategory::class, 'product_for_categories', 'productable_id', 'machine_id');
        return $this->morphOne(ProductForCategory::class, 'productable');
    }

    public function images()
    {
        return $this->morphMany(UploadImage::class, 'imageable');
    }

    public function properties()
    {
        return $this->morphMany(ProductProperties::class, 'productable');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
