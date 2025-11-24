<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;
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
        if (isset($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        if (isset($data['primary_image'])) {
            $data['primary_image'] = $this->uploadPrimaryImage($data['primary_image']);
        }

        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::find($id);
        if (!$category) {
            throw new ModelNotFoundException("Model not found");
        }
        if (isset($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $category->id);
        }

        if (isset($data['primary_image'])) {
            // حذف عکس قبلی
            if ($category->primary_image && file_exists(public_path('categories/' . $category->primary_image))) {
                unlink(public_path('categories/' . $category->primary_image));
            }
            $data['primary_image'] = $this->uploadPrimaryImage($data['primary_image']);
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
    public function allWithAccountsCount()
    {
        return Category::withCount('accounts')->get();
    }
    public function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        $query = Category::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
        return $query->exists();
    }
    public function uploadPrimaryImage($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('categories'), $filename);
        return $filename;
    }
}
