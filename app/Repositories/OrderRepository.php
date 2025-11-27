<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderRepository
{
    /*
    |--------------------------------------------------------------------------
    | Order Counts
    |--------------------------------------------------------------------------
    */
    public function allOrdersCount()
    {
        return Order::count();
    }

    public function completedOrdersCount()
    {
        return Order::where('status', 'completed')->count();
    }

    public function pendingOrdersCount()
    {
        return Order::where('status', 'pending')->count();
    }

    public function totalRevenue()
    {
        return Order::where('status', 'completed')->sum('price');
    }
    /*
    |--------------------------------------------------------------------------
    | CRUD Methods
    |--------------------------------------------------------------------------
    */
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
        return Order::with(['user', 'orderItems.account.category'])->findOrFail($id);
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
        $orderitem->update($data);
        return $orderitem;
    }
    public function delete($id)
    {
        $orderitem = Order::find($id);
        if (!$orderitem) {
            throw new ModelNotFoundException("Model not found");
        }
        return $orderitem->delete();
    }
}
