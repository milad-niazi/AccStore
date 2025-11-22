<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $user = User::find($id);
        if (!$user) {
            throw new ModelNotFoundException("Model not found");
        }
        return User::find($id);
    }
    public function findByEmail($email)
    {
        $user = User::find($email);
        if (!$user) {
            throw new ModelNotFoundException("Model not found");
        }
        return User::where('email', $email)->first();
    }


    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
        if (!$user) {
            throw new ModelNotFoundException("Model not found");
        }
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new ModelNotFoundException("Model not found");
        }
        return $user->delete();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        return $user->restore();
    }
}
