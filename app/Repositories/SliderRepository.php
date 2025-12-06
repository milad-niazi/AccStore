<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository
{
    protected $model;

    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

    // دریافت همه اسلایدرها
    public function all()
    {
        return $this->model->latest()->get();
    }

    // پیدا کردن یک اسلایدر
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // ایجاد اسلایدر
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // بروزرسانی اسلایدر
    public function update($id, array $data)
    {
        $slider = $this->find($id);
        $slider->update($data);
        return $slider;
    }

    // حذف نرم (Soft Delete)
    public function delete($id)
    {
        $slider = $this->find($id);
        $slider->delete();
    }

    // لیست رکوردهای حذف شده
    public function trashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    // بازیابی رکورد حذف شده
    public function restore($id)
    {
        $slider = $this->model->onlyTrashed()->findOrFail($id);
        $slider->restore();
    }

    // حذف کامل
    public function forceDelete($id)
    {
        $slider = $this->model->onlyTrashed()->findOrFail($id);
        if ($slider->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($slider->image);
        }
        $slider->forceDelete();
    }
}
