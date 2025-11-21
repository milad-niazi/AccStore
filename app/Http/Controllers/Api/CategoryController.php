<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryController extends ApiController
{
    protected $categoryRepo;
    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepo->allWithAccounts();
        return $this->successResponse(CategoryResource::collection($categories), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $data = $request->only('name', 'description');

        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;
        if ($request->hasFile('primary_image')) {
            $file = $request->file('primary_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('categories'), $filename);
            $data['primary_image'] = $filename;
        }
        $category = Category::create($data);
        return $this->successResponse(new CategoryResource($category), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($category)
    {
        return $this->successResponse(new CategoryResource($this->categoryRepo->find($category)), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $data = $request->only('name', 'description');

        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;
        if ($request->hasFile('primary_image')) {
            $file = $request->file('primary_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('categories'), $filename);
            $data['primary_image'] = $filename;
        }
        $category->update($data);
        return $this->successResponse(new CategoryResource($category), 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categoryRepo->delete($category);
        return $this->successResponse('Category Deleted!', 200);
    }
}
