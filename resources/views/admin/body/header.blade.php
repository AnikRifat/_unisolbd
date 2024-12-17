@php
//   session()->forget('hierarchicalData');
//   dd(session()->get('hierarchicalData'));
    $userID = Auth::guard('admin')->user()->id;
    // dd(session()->has('hierarchicalData'));
    if (!session()->has('hierarchicalData')) {
        $rolePermissions = App\Models\RolePermission::select('role_permissions.*', 'modules.ordering as module_ordering', 'menus.ordering as menu_ordering', 'submenus.ordering as submenu_ordering', 'menus.prefix as menu_prefix', 'menus.route as menu_route')
            ->join('menus', 'role_permissions.menu_id', '=', 'menus.id')
            ->leftJoin('submenus', 'role_permissions.submenu_id', '=', 'submenus.id')
            ->join('modules', 'menus.module_id', '=', 'modules.id') // Join the 'modules' table
            ->with('module', 'menu', 'submenu', 'permission')
            ->whereIn('role_id', function ($query) use ($userID) {
                // Subquery to retrieve the role_ids from user_roles table based on the user_id
                $query
                    ->select('role_id')
                    ->from('user_roles')
                    ->where('user_id', $userID);
            })
            ->orderBy('module_ordering') // Use the alias for ordering
            ->orderBy('menu_ordering') // Use the alias for ordering
            ->orderBy('submenu_ordering') // Use the alias for ordering
            ->get();

        $hierarchicalData = [];

        foreach ($rolePermissions as $item) {
            $moduleName = $item->module ? $item->module->name : null;
            $menuName = $item->menu ? $item->menu->name : null;
            $submenuName = $item->submenu ? $item->submenu->name : null;
            $permissionId = $item->permission_id;
            $menuRoute = $item->menu ? $item->menu->route : null;
            $menuPrefix = $item->menu ? $item->menu->prefix : null;
            $submenuRoute = $item->submenu ? $item->submenu->route : null;
            // Create the module if it doesn't exist
        if (!isset($hierarchicalData[$moduleName])) {
            $hierarchicalData[$moduleName] = [
                'id' => $item->module->id,
                'icon' => $item->module->icon,
                'bg_color' => $item->module->bg_color,
                'menu' => [],
            ];
        }

        // Create the menu if it doesn't exist
            if (!isset($hierarchicalData[$moduleName]['menu'][$menuName])) {
                $hierarchicalData[$moduleName]['menu'][$menuName] = [
                    'icon' => $item->menu->icon,
                    'prefix' => $menuPrefix, // You can set this based on your data
                    'route' => $menuRoute,
                    'url' => $menuRoute != null ? route($menuRoute) : null,
                    'submenu' => [],
                ];
            }

            // Check if submenu is null or not
            if ($submenuName === null) {
                // Add the permission to the menu
                $hierarchicalData[$moduleName]['menu'][$menuName]['submenu'] = null;
                $hierarchicalData[$moduleName]['menu'][$menuName]['permissions'][] = $permissionId;
            } else {
                // Create the submenu if it doesn't exist
            if (!isset($hierarchicalData[$moduleName]['menu'][$menuName]['submenu'][$submenuName])) {
                $hierarchicalData[$moduleName]['menu'][$menuName]['submenu'][$submenuName] = [
                    'route' => $submenuRoute,
                    'url' => route($submenuRoute),
                    'permissions' => [],
                ];
            }

            // Add the permission to the submenu
            $hierarchicalData[$moduleName]['menu'][$menuName]['submenu'][$submenuName]['permissions'][] = $permissionId;
        }
    }

    session(['hierarchicalData' => $hierarchicalData]);

}


if (!empty(session('hierarchicalData'))) {
    if (!session()->has('activeModule')) {
    // Set the active module data in the session
    $firstModuleName = key(session('hierarchicalData'));
    $activeModuleData = session('hierarchicalData')[$firstModuleName];
    session(['activeModule' => $activeModuleData]);
}
    }


$hierarchicalData = session('hierarchicalData');
$activeModule = session('activeModule');

//   session()->forget('hierarchicalData');
//   dd(session()->get('hierarchicalData'));
@endphp




<style>
    .custom-dropdown {
        /* max-height: 200px;
        overflow-y: auto; */
        min-width: 20rem;
        padding: 20px;
    }

    .btn-app {
        margin: 10px 10px;
    }
</style>


<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu"
                        role="button">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- full Screen -->
                <li class="search-bar">
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="s">
                    </div>
                </li>
                <!-- Notifications -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown"
                        title="Notifications">
                        <i class="ti-bell"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                        <li class="header">
                            <div class="p-20">
                                <div class="flexbox">
                                    <div>
                                        <h4 class="mb-0 mt-0">Notifications</h4>
                                    </div>
                                    <div>
                                        <a href="#" class="text-danger">Clear All</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu sm-scrol">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit
                                        blandit.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien
                                        elementum, in semper diam posuere.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo
                                        porttitor pretium a erat.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum
                                        fermentum.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum,
                                        at scelerisque ipsum imperdiet.
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all</a>
                        </li>
                    </ul>
                </li>


                @php
                    $adminData = DB::table('admins')->find(Auth::id());
                @endphp


                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0"
                        data-toggle="dropdown" title="User">
                        <img src="{{ !empty($adminData->profile_photo_path) ? url($adminData->profile_photo_path) : url('upload/no_image.jpg') }}"
                            alt="">
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                    class="ti-user text-muted mr-2"></i> Profile</a>
                            <a class="dropdown-item" href="{{ route('admin.change.password') }}"><i
                                    class="ti-wallet text-muted mr-2"></i> Change Password</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i>
                                Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                    class="ti-lock text-muted mr-2"></i> Logout</a>
                        </li>
                    </ul>
                </li>


                <li class="d-none">
                    <a href="#" data-toggle="dropdown" title="Setting" class="waves-effect waves-light">
                        <i class="ti-layout-grid2-alt"></i>
                    </a>
                    <ul class="dropdown-menu animated flipInX custom-dropdown">
                        <li class="module-body">
                            <div class="row justify-content-center align-items-center">
                                @foreach ($hierarchicalData as $moduleName => $moduleData)
                                    @php
                                        $isActive = $moduleData['id'] === $activeModule['id'];
                                        $borderClass = $isActive ? 'b-3 b-dotted border-danger' : '';
                                    @endphp
                                    <a id="module{{ $moduleData['id'] }}"
                                        class="btn btn-app {{ $moduleData['bg_color'] }} {{ $borderClass }}"
                                        onclick="moduleWiseData('{{ $moduleName }}')">
                                        <i class="fa {{ $moduleData['icon'] }}"></i> {{ $moduleName }}
                                    </a>
                                @endforeach


                            </div>
                        </li>
                    </ul>

                </li>

            </ul>
        </div>
    </nav>
</header>


