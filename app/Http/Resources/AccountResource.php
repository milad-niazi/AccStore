<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'category_id ' => $this->category_id ,
            'title' => $this->title,
            'username' => $this->username,
            'password' => $this->password,
            'price' => $this->price,
            'status' => $this->status,
            'sold_to' => $this->sold_to ,
            'sold_at' => $this->sold_at,
            'expires_at' => $this->expires_at,
            'description' => $this->description,
        ];
    }
}
