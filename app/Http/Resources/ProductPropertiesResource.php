<?php

namespace App\Http\Resources;

use App\Models\Properties;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPropertiesResource extends JsonResource
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
            'property' => PropertyResource::make(Properties::find($this->properties_id)),
            'value' => $this->value,
            'isDimension' => $this->isDimension,
            'dimension' => $this->dimension,
        ];
    }
}
