@extends('admin.admin_master')
@section('admin')
    <style>
        .form-control.danger {
            border: 1px solid red;
        }

        #mainThmb {
            margin: 10px 0px;
            width: 60px;
            height: 60px;
        }

        .icon {
            height: 40px;
            width: 40px;
        }

        .box-body ul li{
            line-height: 0px;
        }
    </style>

<link rel="stylesheet" href="{{ asset('backend/custom/jstree/simTree.css') }}">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">



    <div class="container-full">
        <!-- Main content -->
        <section class="content pt-0">
            <div class="row ml-md-50">
                    <div class="box">
                        <div class="box-header with-border py-2">
                            <h4 class="box-title d-block">Add Permission</h4>
                            <p class="box-title">Add/Edit Permission</p>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pt-0">
                          
                            <div class="row pl-45">
                                <p class="font-weight-bold font-size-18" id="role"> {{ $role->name }}</p>
                            </div>
                            <div class="row" style="height: 340px; overflow-y: auto;">
                                <div id="tree" ></div>
                             </div>
                             <div class="row justify-content-center">
                                <div>
                                    <button id="btnSubmit" class="btn btn-sm btn-success "> Submit</button>
                                </div>
                             </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
              
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>


     <!-- Include the simTree plugin script -->
     <script src="{{ asset('backend/custom/jstree/simTree.js') }}"></script>

     <script>
        $(document).ready(function() {
            var roleId = {!! json_encode($role->id) !!};
            // Make an Ajax request to get modules
            $.ajax({
                type: "get",
                url: "{{ route('role-permission.index') }}",
                data: {
                    role_id: roleId
                },
                dataType: "json",
                success: function(response) {
                    // Call the function to render the tree with the Ajax response
                    console.log(response);
                    console.log("permissionItems ", response.permissionItems);
                    renderTree(response);
                }
            });

            // Function to render the tree
            function renderTree(response) {
                console.log("permissions ", response.permissions)
                var treeData = [];

                var modules = response.modules
                var permissions = response.permissions

                console.log("response.rolePermissions ", response.rolePermissions)

                modules.forEach(function(module) {

                    // Add the module as a parent node
                    treeData.push({
                        id: "module"+module.id,
                        name: module.name,
                        type: "module",
                    });

                    // Add menus as child nodes under the module
                    module.menus.forEach(function(menu) {
                        const hasSubmenus = module.submenus.some(sub => parseInt(sub.menu_id) == parseInt(menu.id));

                        console.log("hasSubmenus : ",hasSubmenus);

                        treeData.push({
                            pid: "module"+menu.module_id,
                            id: "menu" + menu.id,
                            name: menu.name,
                            module_id: menu.module_id,
                            menu_id: menu.id,
                            type: "menu",
                        });

                        if (!hasSubmenus) {
                            permissions.forEach(function(permission) {


                                const existsInRolePermissions = response.rolePermissions.some(
                                rolePermission =>
                                parseInt(rolePermission.menu_id) == parseInt(menu.id) &&
                                parseInt(rolePermission.permission_id) == parseInt(permission.id)
                            );

                             // Set isChecked based on whether the combination exists in rolePermissions
                             var isChecked = existsInRolePermissions;

                             console.log("permission ",permission)
                             console.log("existsInRolePermissions ",isChecked)


                                if (parseInt(permission.menu_id) == 0) {
                                    treeData.push({
                                        pid: "menu"+menu.id,
                                        id: "permission"+menu.id+permission.id,
                                        name: permission.name,
                                        module_id: module.id,
                                        menu_id: menu.id,
                                        submenu_id: null,
                                        permission_id: permission.id,
                                        type: "permission",
                                        checked: isChecked,
                                    });
                                }
                            });
                        }

                    });


                    module.submenus.forEach(function(submenu) {

                        treeData.push({
                            pid: "menu" + submenu.menu_id,
                            id: "submenu" + submenu.id,
                            name: submenu.name,
                            module_id: submenu.module_id,
                            menu_id: submenu.menu_id,
                            submenu_id: submenu.id,
                            type: "submenu",
                        });

                        permissions.forEach(function(permission) {

                            const existsInRolePermissions = response.rolePermissions.some(
                                rolePermission =>
                                parseInt(rolePermission.submenu_id) === parseInt(submenu.id) &&
                                parseInt(rolePermission.permission_id) === parseInt(permission.id)
                            );

                             // Set isChecked based on whether the combination exists in rolePermissions
                             var isChecked = existsInRolePermissions;

                            console.log("submenu: " + submenu.id + " permission_id: " +
                                permission.id);
                            console.log("existsInRolePermissions: ",
                                existsInRolePermissions);

                           

                            if (parseInt(permission.menu_id) === 0) {
                                treeData.push({
                                    pid: "submenu" + submenu.id,
                                    id : "permission"+submenu.module_id+submenu.menu_id+submenu.id+permission.id,
                                    name: permission.name,
                                    module_id: module.id,
                                    menu_id: submenu.menu_id,
                                    submenu_id: submenu.id,
                                    permission_id: permission.id,
                                    type: "permission",
                                    checked: isChecked, // Set the checked property
                                });
                            }

                            if (parseInt(permission.menu_id) === parseInt(submenu.menu_id)) {
                                treeData.push({
                                    pid: "submenu" + submenu.id,
                                    id : "permission"+submenu.module_id+submenu.menu_id+submenu.id+permission.id,
                                    name: permission.name,
                                    module_id: module.id,
                                    menu_id: submenu.menu_id,
                                    submenu_id: submenu.id,
                                    permission_id: permission.id,
                                    type: "permission",
                                    checked: isChecked, // Set the checked property
                                });
                            }

                        });

                    });

                });

                var permissionItems;
                var tree = simTree({
                    el: '#tree',
                    data: treeData,
                    check: true,
                    linkParent: true,
                    onClick: function(item) {
                        permissionItems = item.filter(item => item.type === "permission");
                        console.log("permissionItems ", permissionItems);
                    },
                   
                });

                $("#btnSubmit").on("click", function() {
                    var roleId = {!! json_encode($role->id) !!};
                    // Send the data to the server
                    sendPermissionData(permissionItems, roleId);
                });

                function sendPermissionData(permissionItems, roleId) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('role-permission.store') }}",
                        data: JSON.stringify({
                            permissionItems: permissionItems,
                            role_id: roleId
                        }),
                        contentType: "application/json", // Set the content type to JSON
                        dataType: "json",
                        success: function(response) {
                            
                            console.log("Response from success ajax: ", response);
                            // Handle the response here as needed
                            showToastr(response.type, response.message)
                            window.location.href = "{{ route('role.index') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error("Error from AJAX request: ", error);
                            // Handle the error here
                        }
                    });
                }

            }


        });
    </script>

@endsection
