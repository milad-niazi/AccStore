<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;

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
        return view('web.home.index', compact('sliders'));
    }
}
