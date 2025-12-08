<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReviewRepository;
use App\Repositories\SliderRepository;

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
        $reviews = $this->reviewRepo->allActive();

        return view('web.home.index', compact('sliders', 'reviews'));
    }
}
