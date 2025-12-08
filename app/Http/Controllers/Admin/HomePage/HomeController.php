<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\Http\Controllers\Controller;
use App\Repositories\ReviewRepository;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected SliderRepository $sliderRepo;
    protected ReviewRepository $reviewRepo;

    public function __construct(SliderRepository $sliderRepo, ReviewRepository $reviewRepo)
    {
        $this->sliderRepo = $sliderRepo;
        $this->reviewRepo = $reviewRepo;
    }
    public function index()
    {
        $sliders = $this->sliderRepo->all();
        return view('admin.home.index', compact('sliders'));
    }
}
