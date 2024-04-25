<?php

namespace App\Http\Controllers\Backend\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slider = Slider::latest()->where('type', 2)->get();

        return view('backend.landingPage.slider.slider', compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;

        $request->validate([
            'slider_img' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'type' => 2,
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        if ($request->file('slider_img')) {
            $data['slider_img'] = uploadAndResizeImage($request->file('slider_img'), 'upload/slider', 1366, 768); // Fixed the function parameters
        }

        Slider::insert($data);

        return redirect()->back()->with(notification('Slider Add Successfully', 'success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request;

        $data = [
            'title' => $request->title,
            'type' => 2,
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        $slider = Slider::FindOrFail($id);

        if ($request->file('slider_img')) {
            @unlink($slider->slider_img);
            $data['slider_img'] = uploadAndResizeImage($request->file('slider_img'), 'upload/slider', 1366, 768); // Fixed the function parameters
        }

        Slider::findOrFail($id)->update($data);

        return redirect()->back()->with(notification('Slider Update Successfully', 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ActiveSlider($id)
    {
        Slider::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Slider Active Successfully', 'success'));
    }

    public function InactiveSlider($id)
    {
        Slider::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Slider Inactive Successfully', 'success'));
    }
}
