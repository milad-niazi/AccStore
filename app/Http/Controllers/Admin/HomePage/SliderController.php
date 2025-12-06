<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    protected $repository;

    public function __construct(SliderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $sliders = $this->repository->all();
        return view('admin.homepage.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.homepage.sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $this->repository->create($data);

        return redirect()->route('admin.homepage.sliders.index')
            ->with('success', 'اسلایدر با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $slider = $this->repository->find($id);
        return view('admin.homepage.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        $slider = $this->repository->find($id);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $this->repository->update($id, $data);

        return redirect()->route('admin.homepage.sliders.index')
            ->with('success', 'اسلایدر با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.homepage.sliders.index')
            ->with('success', 'اسلایدر حذف شد.');
    }

    public function trashed()
    {
        $sliders = $this->repository->trashed();
        return view('admin.homepage.sliders.trashed', compact('sliders'));
    }

    public function restore($id)
    {
        $this->repository->restore($id);
        return redirect()->route('admin.homepage.sliders.index')
            ->with('success', 'اسلایدر بازیابی شد.');
    }

    public function forceDelete($id)
    {
        $this->repository->forceDelete($id);
        return redirect()->route('admin.homepage.sliders.index')
            ->with('success', 'اسلایدر برای همیشه حذف شد.');
    }
}
