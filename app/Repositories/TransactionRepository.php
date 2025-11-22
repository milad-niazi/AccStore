<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionRepository
{
    public function all()
    {
        return Transaction::with('order.orderItems.account')->get();
    }
    public function findById($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            throw new ModelNotFoundException("Model not found");
        }
        return Transaction::with('order.orderItems.account')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }
    public function update($id, array $data)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            throw new ModelNotFoundException("Model not found");
        }
        $transaction->update($data);
        return $transaction;
    }
    public function delete($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            throw new ModelNotFoundException("Model not found");
        }
        return $transaction->delete();
    }

}
