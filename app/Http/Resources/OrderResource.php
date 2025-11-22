<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\OrderItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'price' => $this->price,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'order_items' => OrderItemResource::collection(
                $this->whenLoaded('orderItems')
            ),
        ];
    }
}
