<?php

namespace App\Http\Resources;

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
            'weight' => $this->weight,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'hole' => $this->hole,
            'previewImage' => $this->previewImage,
            'carouselImages' => UploadImageResource::collection($this->carouselImages),

            'brand' => $this->brand->name,
            'machines' => MachineResource::collection($this->machines),
        ];
    }
}
