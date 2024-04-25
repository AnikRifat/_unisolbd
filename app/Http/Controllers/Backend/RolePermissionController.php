<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permissionItems = RolePermission::where('role_id', $request->role_id)->get();
        $modules = Module::with('menus', 'submenus')->orderBy('id', 'asc')->get();
        $permissions = Permission::get();

        return response()->json([
            'role' => $role,
            'modules' => $modules,
            'permissions' => $permissions,
            'rolePermissions' => $permissionItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $newActiveModule = $request->input('newActiveModule');
        $activeModuleData = session('hierarchicalData')[$newActiveModule];
        Session::forget('activeModule');
        session(['activeModule' => $activeModuleData]);
        $activeModule = Session::get('activeModule');

        return response()->json($activeModule);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $requestData = json_decode($request->getContent(), true);
        $permissionItems = $requestData['permissionItems'];
        $roleId = $requestData['role_id'];

        // Delete all existing role permissions for the given role ID
        RolePermission::where('role_id', $roleId)->delete();

        foreach ($permissionItems as $data) {
            // Insert new role permissions
            RolePermission::create([
                'module_id' => $data['module_id'],
                'menu_id' => $data['menu_id'],
                'submenu_id' => $data['submenu_id'],
                'permission_id' => $data['permission_id'],
                'role_id' => $roleId,
                'created_at' => Carbon::now(),
            ]);
        }

        return response()->json(notification('successfully assign role permission', 'success'));
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
        $role = Role::findOrFail($id);

        return view('backend.administration.role_permission', compact('role'));
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
}
