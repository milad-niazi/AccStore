<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'primary_image' => $this->primary_image,
            'description' => $this->description,
            'accounts' => AccountResource::collection($this->whenLoaded('accounts')),
        ];
    }
}
