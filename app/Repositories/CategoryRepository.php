<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository
{
    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new ModelNotFoundException("Model not found");
        }
        return Category::with('accounts')->find($id);
    }


    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new ModelNotFoundException("Model not found");
        }
        $category->update($data);
        return $category;
    }


    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new ModelNotFoundException("Model not found");
        }
        $category->delete();
        return $category;
    }

    public function allWithAccounts()
    {
        return Category::with('accounts')->get();
    }
}
