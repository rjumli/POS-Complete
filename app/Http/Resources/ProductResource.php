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
            'type' => 'Product',
            'code' => $this->code,
            'name' => $this->name,
            'brand' => $this->brand,
            'stock' => $this->stock,
            'price' => $this->price,
            'category' => $this->category,
            'unit' => $this->unit,
            'pricing' => $this->pricing,
            'discount' => (count($this->discounts) > 0) ? $this->discounts[0] : '',
            'created_at' => $this->created_at,
            'warranty' => $this->warranty,
            'has_warranty' => ($this->warranty) ? true : false,
        ];
    }
}
