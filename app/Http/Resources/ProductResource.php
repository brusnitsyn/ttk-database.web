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
            'name' => $this->name,
            'article' => $this->article,
            'cost' => $this->cost,
            'weight' => $this->weight,
            'image' => $this->image,

            'techniques' => TechniqueResource::collection($this->techniques),
            'techniques' => TechniqueResource::collection($this->techniques),
        ];
    }
}
