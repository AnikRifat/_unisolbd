<?php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();

    $hierarchicalData = session('hierarchicalData');
    $activeModule = session('activeModule');
?>

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="<?php echo e(url('admin/dashboard')); ?>">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <h3><b>Hi <?php echo e(Auth::guard('admin')->user()->name); ?></b> </h3>
                    </div>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu"  data-widget="tree">

        <!-- sidebar menu-->
        <li class="treeview ">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z"
                        fill="white" />
                </svg>
                <span>User Management</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo e($route == 'user-management.index' ? 'active' : ''); ?>"><a
                        href="<?php echo e(route('user-management.index')); ?>"><i class="ti-more"></i>All Users</a></li>

                <li class="<?php echo e($route == 'customer-groups.index' ? 'active' : ''); ?>"><a
                        href="<?php echo e(route('customer-groups.index')); ?>"><i class="ti-more"></i>User Group</a>
                </li>


            </ul>
        </li>
    </ul>
        <ul class="sidebar-menu" id="dynamicSidebar" data-widget="tree">

            

            <?php if($activeModule!=null): ?>
            <?php $__currentLoopData = $activeModule['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuKey => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li
                    class="<?php echo e($menu['submenu'] != null ? 'treeview' : ''); ?> <?php echo e($menu['submenu'] != null && $prefix == $menu['prefix'] ? 'active' : ''); ?> <?php echo e($route == $menu['route'] ? 'active' : ''); ?>">
                    <a href="<?php echo e($menu['route'] != null ? route($menu['route']) : '#'); ?>">
                        <i data-feather="<?php echo e($menu['icon']); ?>"></i>
                        <span><?php echo e($menuKey); ?></span>
                        <?php if($menu['submenu'] != null): ?>
                            <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                        <?php endif; ?>
                    </a>
                    <?php if($menu['submenu'] != null): ?>
                        <ul class="treeview-menu">
                            <?php $__currentLoopData = $menu['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenuKey => $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e($route == $submenu['route'] ? 'active' : ''); ?>">
                                    <a href="<?php echo e($submenu['url']); ?>">
                                        <i class="ti-more"></i><?php echo e($submenuKey); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>






        </ul>


    </section>
</aside>





<script>
    var activeModule = <?php echo json_encode(session('activeModule')); ?>;

    function moduleWiseData(module) {
        var moduleData = <?php echo json_encode(session('hierarchicalData')); ?>[module];
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
            url: "<?php echo e(route('role-permission.create')); ?>",
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







<?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/admin/body/sidebar.blade.php ENDPATH**/ ?>