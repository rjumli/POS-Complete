<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'brand' => $this->brand,
            'stock' => $this->stock,
            'reorder' => $this->reorder,
            'is_active' => $this->is_active,
            'price' => $this->price,
            'size' => $this->size,
            'category' => $this->category,
            'unit' => $this->unit,
            'pricing' => $this->pricing,
            'percentage' => $this->percentage,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'total' => $this->total(),
            'quantities' => $this->quantities(),
            'discount' => (count($this->discounts) > 0) ? $this->discounts[0] : ''
        ];
    }
}
