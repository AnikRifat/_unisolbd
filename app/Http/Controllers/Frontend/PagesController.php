<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function TermsCondition()
    {
        $setting = SiteSetting::find(1);
        return view('frontend.pages.terms_condition', compact('setting'));
    }
    public function AboutUs()
    {
        $setting = SiteSetting::find(1);
        return view('frontend.pages.about_us', compact('setting'));
    }
    public function ContactUs()
    {
        $setting = SiteSetting::find(1);
        return view('frontend.pages.contact_us', compact('setting'));
    }
    public function FAQS()
    {
        $setting = SiteSetting::find(1);
        return view('frontend.pages.faqs', compact('setting'));
    }
}
