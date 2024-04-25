<?php

namespace App\Http\Controllers\Backend\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::get();

        return view('backend.landingPage.notice.view_notice', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.landingPage.notice.create_notice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        Notice::insert([
            'content' => $request->content,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        // Create a notification message
        $notification = [
            'message' => 'Notice Insert Successfully',
            'type' => 'success',
        ];

        // Redirect back with the notification message
        return redirect()->route('notice.index')->with($notification);
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
        $notice = Notice::findOrFail($id);

        return view('backend.landingPage.notice.edit_notice', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        Notice::findOrFail($id)->update([
            'content' => $request->content,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);

        // Create a notification message
        $notification = [
            'message' => 'Notice Update Successfully',
            'type' => 'success',
        ];

        // Redirect back with the notification message
        return redirect()->route('notice.index')->with($notification);
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

    public function ActiveNotice($id)
    {
        Notice::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Notice Active Successfully', 'success'));
    }

    public function InactiveNotice($id)
    {
        Notice::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Notice Inactive Successfully', 'success'));
    }
}
