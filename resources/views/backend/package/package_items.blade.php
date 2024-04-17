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

        .box-body ul li {
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
                        <h4 class="box-title d-block">Add Package Items</h4>
                        <p class="box-title">Add/Edit Package Items</p>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pt-0">

                        <div class="row pl-45">
                            <p class="font-weight-bold font-size-18" id="role"> {{ $package->name }}</p>
                        </div>
                        <div class="row" style="height: 340px; overflow-y: auto;">
                            <div id="tree"></div>
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
   
         
         
            var packageId = {!! ($package->id) !!};
            var exitsPackageItems = {!! ($packageItems) !!};
            var categories = {!! ($categories) !!};

            console.log("packageId ", packageId);
            console.log("packageItems ", exitsPackageItems);
            console.log("categories ", categories);

    $(document).ready(function() {
             

            // Function to render the tree
            function renderTree() {
               
                var treeData = [];

                categories.forEach(function(category) {
                    
                    console.log("category ",category.id);
                    console.log("category.subcategory ",category.subcategory)

                    // const hasSubcategory = category.subcategory.some(sub => sub.category_id === category.id);
                    
                     const hasSubcategory = category.subcategory.some(sub => parseInt(sub.category_id) === category.id);

                    console.log("hasSubcategory ",hasSubcategory);

                    if(!hasSubcategory){
                        const existsInPackageItems = exitsPackageItems.some(
                            exitsPackageItems => parseInt(exitsPackageItems.category_id) === category.id
                            );
                        var isChecked = existsInPackageItems;

                    treeData.push({
                        id: "category" + category.id,
                        name: category.category_name,
                        category_id: category.id,
                        subcategory_id: null,
                        subsubcategory_id: null,
                        checked:isChecked,
                        type: "category",
                    });
                   }
                   else{
                    treeData.push({
                        id: "category" + category.id,
                        name: category.category_name,
                        category_id: category.id,
                        subcategory_id: null,
                        subsubcategory_id: null,
                        type: "category",
                    });
                   }
                  

                    // Add menus as child nodes under the module
                    category.subcategory.forEach(function(subcategory) {

                        const existsInPackageItems = exitsPackageItems.some(
                            exitsPackageItems => parseInt(exitsPackageItems.subcategory_id) === subcategory.id
                            );
                        var isChecked = existsInPackageItems;


                        treeData.push({
                            pid: "category" + subcategory.category_id,
                            id: "subcategory" + subcategory.id,
                            name: subcategory.subcategory_name,
                            category_id: subcategory.category_id,
                            subcategory_id: subcategory.id,
                            subsubcategory_id: null,
                            checked:isChecked,
                            type: "subcategory",
                        });
                    });


                    category.subsubcategory.forEach(function(subsubcategory) {

                        const existsInPackageItems = exitsPackageItems.some(
                            exitsPackageItems => parseInt(exitsPackageItems.subsubcategory_id) === subsubcategory.id
                            );

                             // Set isChecked based on whether the combination exists in rolePermissions
                             var isChecked = existsInPackageItems;

                        treeData.push({
                            pid: "subcategory" + subsubcategory.subcategory_id,
                            id: "subsubcategory" + subsubcategory.id,
                            name: subsubcategory.subsubcategory_name,
                            category_id: subsubcategory.category_id,
                            subcategory_id: subsubcategory.subcategory_id,
                            subsubcategory_id: subsubcategory.id,
                            checked:isChecked,
                            type: "subsubcategory",
                        });

                    });

                });


                var packageItems = [];

                var tree = simTree({
                    el: '#tree',
                    data: treeData,
                    check: true,
                    linkParent: true,
                    // onClick: function(item) {
                    //     packageItems =[];

                    //     item.forEach(function(item) {
                    //         if (item.type === "category") {
                    //             if (item.children) {
                    //                 item.children.forEach(function(subcategory) {
                    //                     if (subcategory.children) {
                    //                         subcategory.children.forEach(function(subsubcategory) {
                    //                             packageItems.push(subsubcategory);
                    //                         });
                    //                     } else {
                    //                         packageItems.push(subcategory);
                    //                     }
                    //                 });
                    //             } else {
                    //                 packageItems.push(item);
                    //             }
                    //         }
                    //     });
                    //     console.log('packageItems ', packageItems);
                    // }
                    onClick: function(clickedItem) {
                        packageItems = [];
                        // Filter the clickedItem based on whether it has children
                         packageItems = clickedItem.filter((item) => !item.children);
                        console.log("packageItems ", packageItems);
                    }
                });

                $("#btnSubmit").on("click", function() {
                    var packageId = {!! json_encode($package->id) !!};
                    // Send the data to the server
                    sendPackageData(packageItems, packageId);
                });

                function sendPackageData(packageItems, packageId) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('package-item.store') }}",
                        data: JSON.stringify({
                            packageItems: packageItems,
                            package_id: packageId
                        }),
                        contentType: "application/json", // Set the content type to JSON
                        dataType: "json",
                        success: function(response) {
                            console.log("Response from success ajax: ", response);
                            // Handle the response here as needed
                            showToastr(response.type, response.message)
                            window.location.href = "{{ route('package.index') }}";
                          
                        },
                        error: function(xhr, status, error) {
                            console.error("Error from AJAX request: ", error);
                            // Handle the error here
                        }
                    });
                }

            }
                 renderTree();

 });
       
    </script>
@endsection
