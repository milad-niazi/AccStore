<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function all()
    {
        return Order::with('user')->get();
    }
    public function findById($id)
    {
        return Order::with('accounts')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }
    public function update(Order $order, array $data)
    {
        $order->update($data);
        return $order;
    }
    public function delete(Order $order)
    {
        return $order->delete();
    }
}
