<?php

use App\Http\Controllers\Backend\LandingPage\AboutUsController;
use App\Http\Controllers\Backend\LandingPage\IndexController;
use App\Http\Controllers\Backend\LandingPage\MenuController;
use App\Http\Controllers\Backend\LandingPage\NoticeController;
use App\Http\Controllers\Backend\LandingPage\SliderController;
use App\Http\Controllers\Backend\LandingPage\SubmenuController;
use App\Http\Controllers\Backend\LandingPage\SubsubmenuController;
use Illuminate\Support\Facades\Route;



 ///landing page route start from here 

 route::prefix('landing-page')->group(function () {

    Route::resource('menu', MenuController::class);
    Route::post('/menu/active/{id}', [MenuController::class, 'ActiveMenu'])->name('active.menu');
    Route::post('/menu/inactive/{id}', [MenuController::class, 'InactiveMenu'])->name('inactive.menu');

    Route::resource('submenu', SubmenuController::class);
    Route::post('/submenu/active/{id}', [SubmenuController::class, 'ActiveSubmenu'])->name('active.submenu');
    Route::post('/submenu/inactive/{id}', [SubmenuController::class, 'InactiveSubmenu'])->name('inactive.submenu');


    Route::resource('subsubmenu', SubsubmenuController::class);
    Route::get('/get-landing-page-menu', [SubsubmenuController::class, 'getMenu'])->name('get-landing-page-menu');
    Route::post('/subsubmenu/active/{id}', [SubsubmenuController::class, 'ActiveSubsubmenu'])->name('active.subsubmenu');
    Route::post('/subsubmenu/inactive/{id}', [SubsubmenuController::class, 'InactiveSubsubmenu'])->name('inactive.subsubmenu');


    Route::resource('landing-page-slider', SliderController::class);
    Route::post('/slider/active/{id}', [SliderController::class, 'ActiveSlider'])->name('landing-page-slider.active');
    Route::post('/slider/inactive/{id}', [SliderController::class, 'InactiveSlider'])->name('landing-page-slider.inactive');


    Route::resource('notice', NoticeController::class);
    Route::post('/notice/active/{id}', [NoticeController::class, 'ActiveNotice'])->name('active.notice');
    Route::post('/notice/inactive/{id}', [NoticeController::class, 'InactiveNotice'])->name('inactive.notice');

    Route::resource('about-us', AboutUsController::class);

    });
    

//Route::get('/', [IndexController::class, 'Index'])->name('landing-home');