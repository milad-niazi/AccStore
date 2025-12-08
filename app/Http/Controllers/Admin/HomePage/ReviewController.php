<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ReviewRepository;

class ReviewController extends Controller
{
    protected ReviewRepository $reviewRepo;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepo = $reviewRepo;
    }

    public function index()
    {
        $reviews = $this->reviewRepo->all();
        return view('admin.home.reviews.index', compact('reviews'));
    }
    public function toggleStatus($id)
    {
        $review = $this->reviewRepo->find($id);
        $review->is_active = !$review->is_active;
        $review->save();

        return redirect()->back()->with('success', 'Review status updated successfully.');
    }

    public function create()
    {
        return view('admin.home.reviews.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'nullable|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $this->reviewRepo->create($data);

        return redirect()->route('admin.homepage.reviews.index')
            ->with('success', 'Review created successfully.');
    }

    public function edit($id)
    {
        $review = $this->reviewRepo->find($id);
        return view('admin.home.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'nullable|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $this->reviewRepo->update($id, $data);

        return redirect()->route('admin.homepage.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $this->reviewRepo->delete($id);
        return redirect()->route('admin.homepage.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
