<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    protected $sliderRepo;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    public function index()
    {
        $sliders = $this->sliderRepo->all();
        return view('admin.homepage.sliders.index', compact('sliders'));
    }

    public function edit($id)
    {
        $slider = $this->sliderRepo->find($id);
        return view('admin.home.sliders.edit', compact('slider'));
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

        if (!$request->hasFile('image')) {
            unset($data['image']);
        }
        $this->sliderRepo->update($id, $data);

        return redirect()->route('admin.homepage.index')
            ->with('success', 'اسلایدر با موفقیت بروزرسانی شد.');
    }
}
