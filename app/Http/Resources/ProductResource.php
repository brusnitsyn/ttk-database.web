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
            'originalArticle' => isset($this->originalArticle) ? $this->originalArticle : null,
            'actualPrice' => $this->actualPrice,
            'discountPrice' => $this->discountPrice,
            'properties' => ProductPropertiesResource::collection($this->properties),
            'category' => ProductCategoryResource::make($this->category->productCategory),
            // 'weight' => $this->weight,
            // 'width' => $this->width,
            // 'diameter' => $this->diameter,
            // 'thickness' => $this->thickness,
            // 'height' => $this->height,
            // 'length' => $this->length,
            // 'hole' => $this->hole,
            // 'mountingHole' => $this->mounting_hole,
            // 'captureWidth' => $this->capture_width,
            // 'thread' => $this->thread,
            // 'distanceBetweenHoles' => $this->distance_between_holes,
            'description' => $this->description,
            'images' => UploadImageResource::collection($this->images),

            'brand' => BrandResource::make($this->brand),
            'machines' => MachineResource::collection($this->machines),
        ];
    }
}
