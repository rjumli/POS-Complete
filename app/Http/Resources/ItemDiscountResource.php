<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemDiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   $item = ($this->subtype == 'Product') ? $this->product : $this->package;
        return [
            'start' => $this->start,
            'end' => $this->end,
            'subtype' => $this->subtype,
            'is_active' => $this->is_active,
            'type' => $this->type,
            'discount' => $this->discount,
            'item' => new ItemResource($item)
        ];
    }
}
