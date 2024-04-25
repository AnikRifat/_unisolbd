<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function English()
    {
        Session()->get('language');
        Session()->forget('language');
        Session::put('language', 'english');

        return redirect()->back();

    }

    public function Hindi()
    {
        Session()->get('language');
        Session()->forget('language');
        Session::put('language', 'hindi');

        return redirect()->back();

    }
}
