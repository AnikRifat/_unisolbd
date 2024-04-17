<?php

namespace App\Http\Controllers\Backend\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = NavItem::where('type',0)->get();
        return view('backend.landingPage.menu.menu',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.landingPage.menu.menu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        $insertData = [
            'name' => $request->name,
            'type' => 0,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ];

        // Check if $request->link is present and not empty
        if ($request->has('link') && !empty($request->link)) {
            $insertData['link'] = $request->link;
        }

        // Insert the data into the database
        NavItem::insert($insertData);

        // Create a notification message
        $notification = [
            'message' => 'Menu Add Successfully',
            'type' => 'success',
        ];

        // Redirect back with the notification message
        return redirect()->back()->with($notification);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        $insertData = [
            'name' => $request->name,
            'type' => 0,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ];

        // Check if $request->link is present and not empty
        if ($request->has('link') && !empty($request->link)) {
            $insertData['link'] = $request->link;
        }

        // Insert the data into the database
        NavItem::findOrFail($id)->update($insertData);

        // Create a notification message
        $notification = [
            'message' => 'Menu Update Successfully',
            'type' => 'success',
        ];

        // Redirect back with the notification message
        return redirect()->back()->with($notification);
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


    public function ActiveMenu($id)
    {

        NavItem::where('id','=',$id)->update(['status' => 1]);
       
       $notification=array([

           'message' => 'Menu Active Successfully',
           'type' => 'success',
       ]);

       return redirect()->back()->with($notification);

    }

    public function InactiveMenu($id)
    {

        NavItem::where('id','=',$id)->update(['status' => 0]);
       
       $notification=array([

           'message' => 'Menu Inactive Successfully',
           'type' => 'success',
       ]);

       return redirect()->back()->with($notification);

    }

   

}
