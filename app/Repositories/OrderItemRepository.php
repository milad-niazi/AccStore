<?php

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository
{
    public function all()
    {
        return OrderItem::with('account')->get();
    }
    public function findById($id)
    {
        return OrderItem::with(['account', 'order.buyer'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return OrderItem::create($data);
    }
    public function update(OrderItem $order, array $data)
    {
        $order->update($data);
        return $order;
    }
    public function delete($orderItem)
    {
        return $orderItem->delete();
    }
}
