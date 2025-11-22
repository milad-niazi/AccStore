<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'order_id' => $this->order_id,
            'price' => $this->price,

            'account' => new AccountResource(
                $this->whenLoaded('account')
            ),

            'buyer' => new UserResource(
                $this->whenLoaded('order') ? $this->order->buyer : null
            ),
        ];
    }
}
