@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();

    $hierarchicalData = session('hierarchicalData');
    $activeModule = session('activeModule');
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ url('admin/dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <h3><b>Hi {{ Auth::guard('admin')->user()->name }}</b> </h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->


        <ul class="sidebar-menu" id="dynamicSidebar" data-widget="tree">

            {{-- <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                            fill="white" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li> --}}

            @if ($activeModule!=null)
            @foreach ($activeModule['menu'] as $menuKey => $menu)
                <li
                    class="{{ $menu['submenu'] != null ? 'treeview' : '' }} {{ $menu['submenu'] != null && $prefix == $menu['prefix'] ? 'active' : '' }} {{ $route == $menu['route'] ? 'active' : '' }}">
                    <a href="{{ $menu['route'] != null ? route($menu['route']) : '#' }}">
                        <i data-feather="{{ $menu['icon'] }}"></i>
                        <span>{{ $menuKey }}</span>
                        @if ($menu['submenu'] != null)
                            <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                        @endif
                    </a>
                    @if ($menu['submenu'] != null)
                        <ul class="treeview-menu">
                            @foreach ($menu['submenu'] as $submenuKey => $submenu)
                                <li class="{{ $route == $submenu['route'] ? 'active' : '' }}">
                                    <a href="{{ $submenu['url'] }}">
                                        <i class="ti-more"></i>{{ $submenuKey }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            @endif





        </ul>


    </section>
</aside>


{{-- <script>
   function moduleWiseData(module) {
    console.log("module", module);

    var moduleData = {!! json_encode(session('hierarchicalData')) !!}[module];

    console.log({!! json_encode(session('hierarchicalData')) !!}[module]);

    // <ul class="sidebar-menu" id="dynamicSidebar" data-widget="tree">

        @foreach ($hierarchicalData as $moduleKey => $module)
                @foreach ($module['menu'] as $menuKey => $menu)
                <li class="{{ ($menu['submenu'] != null) ? 'treeview' : '' }} {{($menu['submenu'] != null) && ($prefix == $menu['prefix']) ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="mail"></i> <span>{{ $menuKey }}</span>

                        @if ($menu['submenu'] != null)
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                        @endif

                    </a>

                    @if ($menu['submenu'] != null)
                    <ul class="treeview-menu">
                        @foreach ($menu['submenu'] as $submenuKey => $submenu)
                        <li class=""><a href=""><i class="ti-more"></i>{{ $submenuKey }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
                @break
            @endforeach


    // </ul>


}
</script> --}}


<script>
    var activeModule = {!! json_encode(session('activeModule')) !!};

    function moduleWiseData(module) {
        var moduleData = {!! json_encode(session('hierarchicalData')) !!}[module];
        console.log("activeModule ", activeModule);

        // Remove border from previously active module
        var previousActiveModuleId = activeModule.id;

        console.log("previousActiveModuleId ", previousActiveModuleId);
        var previousActiveModuleElement = document.getElementById(`module${previousActiveModuleId}`);
        previousActiveModuleElement.classList.remove('b-3', 'b-dotted', 'border-danger');

        //Set the new active module
        updateActiveModule(module)

        // Apply border to the new active module
        var newActiveModuleId = moduleData.id;

        console.log("newActiveModuleId ", newActiveModuleId)
        var newActiveModuleElement = document.getElementById(`module${newActiveModuleId}`);
        newActiveModuleElement.classList.add('b-3', 'b-dotted', 'border-danger');


        var dynamicSidebar = document.getElementById('dynamicSidebar');
        dynamicSidebar.innerHTML = ''; // Clear the sidebar first

        for (var menuKey in moduleData.menu) {
            var menu = moduleData.menu[menuKey];
            var listItem = document.createElement('li');

            if (menu.submenu != null) {
                listItem.className = 'treeview';
            }

            if (menu.submenu != null && moduleData.menu.prefix == menu.prefix) {
                listItem.className += ' active';
            }


            listItem.innerHTML = `
            <a href="${menu.route!=null? menu.url : '#'}">
        <i data-feather="${menu.icon}"></i>
        <span>${menuKey}</span>
        ${menu.submenu != null ? '<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>' : ''}
    </a>
`;


            if (menu.submenu != null) {
                console.log("menu.submenu.url ", menu.submenu);

                var submenuList = document.createElement('ul');
                submenuList.className = 'treeview-menu';

                for (var submenuKey in menu.submenu) {
                    console.log("menu.submenu[submenuKey][url] ", menu.submenu[submenuKey]['url']);
                    var submenuItem = document.createElement('li');
                    submenuItem.innerHTML =
                        `<a href="${menu.submenu[submenuKey]['url']}"><i class="ti-more"></i>${submenuKey}</a>`;
                    submenuList.appendChild(submenuItem);
                }

                listItem.appendChild(submenuList);
            }

            dynamicSidebar.appendChild(listItem);
        }


        // After adding elements to the DOM, initialize Feather Icons
        feather.replace();
    }




    function updateActiveModule(module) {

        console.log("module from ajax", module)
        $.ajax({
            type: 'GET',
            url: "{{ route('role-permission.create') }}",
            data: {
                newActiveModule: module,
            },
            success: function(data) {
                console.log(data);
                activeModule = data;
                console.log("ajax response : ", data)
                //alert(data.message);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>






{{-- <script>
    function moduleWiseData(module) {
        var moduleData = {!! json_encode(session('hierarchicalData')) !!}[module];
        var dynamicSidebar = document.getElementById('dynamicSidebar');
        dynamicSidebar.innerHTML = ''; // Clear the sidebar first

        for (var menuKey in moduleData.menu) {
            var menu = moduleData.menu[menuKey];
            var listItem = document.createElement('li');

            if (menu.submenu != null) {
                listItem.className = 'treeview';
            }

            if (menu.submenu != null && moduleData.menu.prefix == menu.prefix) {
                listItem.className += ' active';
            }

            // Dynamically set the route using JavaScript
            var updateUrl = menu.route ? menu.route : "#";

            // Create the link element
            var link = document.createElement('a');
            link.href = `{{ route('', '') }}/${updateUrl}`;
            link.innerHTML = `
                <i data-feather="${menu.icon}"></i>
                <span>${menuKey}</span>
                ${menu.submenu != null ? '<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>' : ''}
            `;

            listItem.appendChild(link);

            if (menu.submenu != null) {
                var submenuList = document.createElement('ul');
                submenuList.className = 'treeview-menu';

                for (var submenuKey in menu.submenu) {
                    var submenuItem = document.createElement('li');
                    submenuItem.innerHTML = `<a href="#"><i class="ti-more"></i>${submenuKey}</a>`;
                    submenuList.appendChild(submenuItem);
                }

                listItem.appendChild(submenuList);
            }

            dynamicSidebar.appendChild(listItem);
        }

        // After adding elements to the DOM, initialize Feather Icons
        feather.replace();
    }
</script> --}}
