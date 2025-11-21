<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    public function all()
    {
        return Account::with('category', 'buyer')->get();
    }

    public function find($id)
    {
        return Account::with('category', 'buyer')->find($id);
    }

    public function create(array $data)
    {
        return Account::create($data);
    }

    public function update(Account $account, array $data)
    {
        $account->update($data); // این true/false میده
        return $account;
    }

    public function delete(Account $account)
    {
        return $account->delete();
    }

    public function available()
    {
        return Account::where('status', 'available')
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })->get();
    }
}
