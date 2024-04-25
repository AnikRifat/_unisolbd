<?php

namespace App\Http\Controllers\Backend\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubsubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $subsubmenus = NavItem::select('nav_items.*', 'submenus.name as submenu_name', 'menus.name as menu_name')
            ->where('nav_items.type', 2) // Filter for subsubmenus
            ->leftJoin('nav_items as submenus', 'nav_items.parent_id', '=', 'submenus.id')
            ->leftJoin('nav_items as menus', 'submenus.parent_id', '=', 'menus.id')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subsubmenus = NavItem::select('nav_items.*', 'submenus.name as submenu_name', 'menus.name as menu_name')
            ->where('nav_items.type', 2) // Filter for subsubmenus
            ->leftJoin('nav_items as submenus', 'nav_items.parent_id', '=', 'submenus.id')
            ->leftJoin('nav_items as menus', 'submenus.parent_id', '=', 'menus.id')
            ->get();

        $menus = NavItem::where('type', 0)->get();

        return view('backend.landingPage.subsubmenu.subsubmenu', compact('menus', 'subsubmenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        $insertData = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'type' => 2,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ];

        // Check if $request->link is present and not empty
        if ($request->has('link') && ! empty($request->link)) {
            $insertData['link'] = $request->link;
        }

        // Insert the data into the database
        NavItem::insert($insertData);

        return notification('subsubmenu insert successfully', 'success');
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
        return $subsubmenu = NavItem::select('nav_items.*', 'submenus.id as submenu_id', 'menus.id as menu_id')
            ->where('nav_items.id', $id) // Specify the table for the 'id' column
            ->leftJoin('nav_items as submenus', 'nav_items.parent_id', '=', 'submenus.id')
            ->leftJoin('nav_items as menus', 'submenus.parent_id', '=', 'menus.id')
            ->first();
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
            'parent_id' => 'required',
            'name' => 'required',
        ]);

        // Create an array to hold the values to be inserted
        $insertData = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'type' => 2,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ];

        // Check if $request->link is present and not empty
        if ($request->has('link') && ! empty($request->link)) {
            $insertData['link'] = $request->link;
        }

        // Update the data into the database
        NavItem::findOrFail($id)->update($insertData);

        return notification('subsubmenu Updated successfully', 'success');
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

    public function getMenu(Request $request)
    {
        return NavItem::where('parent_id', $request->id)->get();
    }

    public function ActiveSubsubmenu($id)
    {
        NavItem::where('id', '=', $id)->update(['status' => 1]);

        return notification('Menu Active Successfully', 'success');
    }

    public function InactivesubSubmenu($id)
    {
        NavItem::where('id', '=', $id)->update(['status' => 0]);

        return notification('Menu Inactive Successfully', 'success');
    }
}
