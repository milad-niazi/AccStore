<?php

namespace App\Repositories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderItemRepository
{
    public function all()
    {
        return OrderItem::with('account')->get();
    }
    public function findById($id)
    {
        $orderitem = OrderItem::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        return OrderItem::with(['account', 'order.buyer'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return OrderItem::create($data);
    }
    public function update($id, array $data)
    {
        $orderitem = OrderItem::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        $id->update($data);
        return $id;
    }
    public function delete($id)
    {
        $orderitem = OrderItem::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        return $id->delete();
    }
}
