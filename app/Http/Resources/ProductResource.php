<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => substr($this->description, 0, 250) . '...',
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'unit_price' => $this->unit_price,
            'discount' => $this->discount,
            'lower_price' => $this->lower_price,
            'images' => $this->images,
        ];
    }
}
