<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SliderRepository;

class HomeController extends Controller
{
    protected SliderRepository $sliderRepo;
    protected ReviewRepository $reviewRepo;
    protected CategoryRepository $categoryRepo;


    public function __construct(SliderRepository $sliderRepo, ReviewRepository $reviewRepo, CategoryRepository $categoryRepo)
    {
        $this->sliderRepo = $sliderRepo;
        $this->reviewRepo = $reviewRepo;
        $this->categoryRepo = $categoryRepo;
    }
    public function index()
    {
        $sliders = $this->sliderRepo->all();
        $reviews = $this->reviewRepo->allActive();
        $categories = $this->categoryRepo->all();


        return view('web.home.index', compact('sliders', 'reviews', 'categories'));
    }
}
