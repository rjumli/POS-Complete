<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserApiResource extends JsonResource
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
            'email' => $this->email,
            'avatar' => 'https://genpos8.com/images/avatars/administrator.jpg',
            'role' => ($this->is_admin) ? 'Administrator' : 'User',
            'is_active' => $this->is_active,
            'name' => ucwords(strtolower($this->name)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
