<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function paginate($perPage)
    {
        return User::query()->paginate($perPage);
    }

    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete(); // soft delete
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        return $user->restore();
    }
}
