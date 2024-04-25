<?php

namespace App\Http\Controllers\Backend\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\NavItem;
use App\Models\Slider;

class IndexController extends Controller
{
    public function Index()
    {
        $menus = NavItem::where('type', 0)->get();
        $sliders = Slider::where('type', 2)->get();
        $aboutUs = AboutUs::first();

        return view('frontend.landing_page.index', compact('menus', 'sliders', 'aboutUs'));
    }
}
