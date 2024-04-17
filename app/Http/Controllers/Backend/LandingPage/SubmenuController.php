<?php

namespace App\Http\Controllers\Backend\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmenuController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $submenus = NavItem::select('nav_items.*', 'parent.name as parent_name')
            ->where('nav_items.type', 1) // Filter for submenus
            ->leftJoin('nav_items as parent', 'nav_items.parent_id', '=', 'parent.id')
            ->get();

        $menus = NavItem::where('type', 0)->get();
        return view('backend.landingPage.submenu.submenu', compact('menus','submenus'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $submenus = NavItem::select('nav_items.*', 'parent.name as parent_name')
            ->where('nav_items.type', 1) // Filter for submenus
            ->leftJoin('nav_items as parent', 'nav_items.parent_id', '=', 'parent.id')
            ->get();
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
            'parent_id' => 'required',
            'name' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        $insertData = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'type' => 1,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ];

        // Check if $request->link is present and not empty
        if ($request->has('link') && !empty($request->link)) {
            $insertData['link'] = $request->link;
        }

        // Insert the data into the database
        NavItem::insert($insertData);

        return notification('submenu insert successfully', 'success');
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
       return NavItem::findOrFail($id);
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

        //return $id;
       // Validate the request data
       $request->validate([
        'parent_id' => 'required',
        'name' => 'required',
    ]);

    // Create an array to hold the values to be inserted
    $insertData = [
        'name' => $request->name,
        'parent_id' => $request->parent_id,
        'updated_at' => Carbon::now(),
        'updated_by' => Auth::user()->id,
    ];

    // Check if $request->link is present and not empty
    if ($request->has('link') && !empty($request->link)) {
        $insertData['link'] = $request->link;
    }

    // update the data into the database
    NavItem::findOrFail($id)->update($insertData);

    return notification('submenu update successfully', 'success');
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


    public function ActiveSubmenu($id)
    {
        NavItem::where('id','=',$id)->update(['status' => 1]);
        return notification('Menu Active Successfully','success');
    }

    public function InactiveSubmenu($id)
    {
        NavItem::where('id','=',$id)->update(['status' => 0]);
       return notification('Menu Inactive Successfully','success');
    }
}
