<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderRepository
{
    public function all()
    {
        return Order::with('user')->get();
    }
    public function findById($id)
    {
        $orderitem = Order::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        return Order::with('accounts')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }
    public function update($id, array $data)
    {
        $orderitem = Order::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        $id->update($data);
        return $id;
    }
    public function delete($id)
    {
        $orderitem = Order::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        return $id->delete();
    }
}
