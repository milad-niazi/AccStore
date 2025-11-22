<?php

namespace App\Http\Controllers\Api;

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

        $data = $request->only('name', 'description', 'primary_image');

        $category = $this->categoryRepo->create($data);

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
    public function update(Request $request, $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $data = $request->only('name', 'description', 'primary_image');

        $category = $this->categoryRepo->update($category, $data);

        return $this->successResponse(new CategoryResource($category), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $this->categoryRepo->delete($category);
        return $this->successResponse('Category Deleted!', 200);
    }
}
