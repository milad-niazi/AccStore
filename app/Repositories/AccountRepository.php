<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountRepository
{
    public function all()
    {
        return Account::with('category', 'buyer')->get();
    }

    public function findById($id)
    {
        $account = Account::find($id);
        if (!$account) {
            throw new ModelNotFoundException("Model not found");
        }
        return Account::with('category', 'buyer')->find($id);
    }

    public function create(array $data)
    {
        return Account::create($data);
    }

    public function update($id, array $data)
    {
        $account = Account::find($id);
        if (!$account) {
            throw new ModelNotFoundException("Model not found");
        }
        $account->update($data);
        return $account;
    }

    public function delete($id)
    {
        $account = Account::find($id);
        if (!$account) {
            throw new ModelNotFoundException("Model not found");
        }
        return $account->delete();
    }
}
