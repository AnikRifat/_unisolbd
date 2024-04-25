<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialMediaSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialmedia = SocialMediaSetting::latest()->get();

        return view('backend.setting.social_media', compact('socialmedia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'link' => 'required',
        ]);

        SocialMediaSetting::insert([
            'icon' => uploadAndResizeImage($request->file('icon'), 'upload/icon/social-media', 48, 48),
            'link' => $request->link,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with(notification('Successfully Save', 'success'));

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
        $request->validate([
            'link' => 'required',
        ]);

        $data = [
            'link' => $request->link,
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        $media = SocialMediaSetting::FindOrFail($id);

        if ($request->file('icon')) {
            @unlink(public_path($media->icon));
            $data['icon'] = uploadAndResizeImage($request->file('icon'), 'upload/icon/social-media', 48, 48); // Fixed the function parameters
        }

        SocialMediaSetting::findOrFail($id)->update($data);

        return redirect()->back()->with(notification('Successfully Update', 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SocialMediaSetting::findOrFail($id)->delete();

        return redirect()->back()->with(notification('Delete Social Media Successfully', 'success'));
    }

    public function ActiveSocialMedia($id)
    {
        SocialMediaSetting::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Social Media Active Successfully', 'success'));
    }

    public function InactiveSocialMedia($id)
    {
        SocialMediaSetting::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Social Media Inactive Successfully', 'success'));
    }
}
