<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
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

    public function update($id, array $data)
    {
        $user = $this->find($id);
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $user->update($data);
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete(); // soft delete
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        return $user->restore();
    }
}
