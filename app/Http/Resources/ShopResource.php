<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postalCode,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image,
            'is_banned' => $this->isBanned,
            'is_verified' => $this->isVerified,
        ];
    }
}
