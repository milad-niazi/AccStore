<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        // $allCategoriesData = $this->categoryRepo->all();
        // $allWithAccountsCount = $this->categoryRepo->allWithAccountsCount();
        // $CategoriesData = [
        //     'allCategoriesData' => $allCategoriesData,
        //     'allWithAccountsCount' => $allWithAccountsCount
        // ];
        // return view('admin.categories.index', $CategoriesData);
        $categories = $this->categoryRepo->allWithAccountsCount(); // همه دسته‌ها با accounts_count
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!$request->hasFile('primary_image')) {
            unset($data['primary_image']);
        }

        $this->categoryRepo->create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryRepo->find($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryRepo->find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!$request->hasFile('primary_image')) {
            unset($data['primary_image']);
        }

        $this->categoryRepo->update($id, $data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryRepo->delete($id);
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

}
