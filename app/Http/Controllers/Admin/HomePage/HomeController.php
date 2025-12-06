<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected SliderRepository $sliderRepo;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }
    public function index()
    {
        $sliders = $this->sliderRepo->all();
        return view('admin.home.index', compact('sliders'));
    }
}
