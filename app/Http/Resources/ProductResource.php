<?php

namespace App\Http\Resources;

use App\Models\ProductForCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'article' => $this->article,
            'actualPrice' => $this->actualPrice,
            'discountPrice' => $this->discountPrice,
            'properties' => ProductPropertiesResource::collection($this->properties),
            'category' => isset($this->category->productCategory) ? ProductCategoryResource::make($this->category->productCategory) : null,
            'description' => $this->description,
            'images' => UploadImageResource::collection($this->images),

            'brand' => BrandResource::make($this->brand),
            'type' => $this->type,
            'machines' => MachineResource::collection($this->machines),
        ];
    }
}
