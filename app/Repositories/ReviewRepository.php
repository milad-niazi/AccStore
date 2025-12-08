<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    protected Review $model;

    public function __construct(Review $review)
    {
        $this->model = $review;
    }

    public function all()
    {
        return $this->model->with('user', 'category')->get();
    }
    public function allActive()
    {
        return $this->model->where('is_active', 1)
            ->with('user')
            ->latest()
            ->get();
    }


    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $review = $this->find($id);
        $review->update($data);
        return $review;
    }

    public function delete($id)
    {
        $review = $this->find($id);
        return $review->delete();
    }
}
