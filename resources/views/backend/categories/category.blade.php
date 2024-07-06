@php
    function hasPermission($activeRoute, $permissionId, $hierarchicalData) {
    foreach ($hierarchicalData as $module => $moduleData) {
        foreach ($moduleData['menu'] as $menu => $menuData) {
            if ($menuData['route'] === $activeRoute) {
                // Check if the permission ID is in the permissions array
                return in_array($permissionId, $menuData['permissions']);
            }

            if (isset($menuData['submenu'])) {
                foreach ($menuData['submenu'] as $submenu => $submenuData) {
                    if ($submenuData['route'] === $activeRoute) {
                        // Check if the permission ID is in the permissions array
                        return in_array($permissionId, $submenuData['permissions']);
                    }
                }
            }
        }
    }

    return false;
}

// Example usage
$activeRoute = Route::current()->getName(); // Replace with your active route
$permissionId =3; // Replace with your permission ID

// Assuming $hierarchicalData contains your hierarchical menu data
$hierarchicalData = session('hierarchicalData'); // Your provided data structure;

$hasPermission = hasPermission($activeRoute, $permissionId, $hierarchicalData);


@endphp

@extends('admin.admin_master')
@section('admin')

{{-- @if ($hasPermission)
{{ "User has permission for the active route."; }}
@else
{{ "User does not have permission for the active route." }}
@endif --}}

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
</style>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Category List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                        <tr>
                                            <td>{{ $item->category_name }}</td>
                                            <td class="text-center"><img class="icon"
                                                src="{{ asset($item->category_icon) }}" alt=""></td>
                                        <td class="text-center">
                                            @if ($item->status == 1)
                                                <span class="badge bade-fills badge-success">Active</span>
                                            @else
                                                <span class="badge bade-fills badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                            <td class="d-flex justify-content-center ">
                                                <a data-edit="{{ base64_encode($item) }}"
                                                    class="btn btn-sm btn-info btnEdit mr-10"
                                                    href="javascript:void(0)"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                @if ($item->status == 1)
                                                    <form method="POST"
                                                        action="{{ route('inactive.category', $item->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-warning"
                                                            href="javascript:void(0)"><i
                                                                class="fa fa-arrow-up"></i></button>

                                                    </form>
                                                @else
                                                    <form method="POST"
                                                        action="{{ route('active.category', $item->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success"
                                                        href="javascript:void(0)"><i
                                                            class="fa fa-arrow-down"></i></button>
                                                    </form>
                                                @endif
                                                <form method="POST" class="ml-2"
                                                        action="{{ route('destroy.category', $item->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger"
                                                        href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i></button>
                                                    </form>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



                <div class="col-lg-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="categoryForm" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                      @csrf
                                      @method('post')
                                <div class="form-group">
                                    <label class="info-title">Name<span class="text-danger">*</span></label>
                                    <input type="text" id="category_name" name="category_name"
                                        class="form-control form-control-sm">
                                    @error('category_name')
                                        <span class="text-danger errorMessage">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">Icon<span class="text-danger">*</span></label>
                                    <input type="file" id="category_icon" name="category_icon"
                                        onchange="mainThamUrl(this)" class="form-control form-control-sm">
                                    @error('category_icon')
                                        <span class="text-danger errorMessage">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                    <a id="btnClear" class="btn  btn-sm btn-primary">Clear</a>
                                </div>

                                </form>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>


    <script>
        $(document).ready(function() {
            $('.btnEdit').click(function() {
                var base64EncodedValue = $(this).data('edit');
                var editData = JSON.parse(atob(base64EncodedValue));

                console.log(editData.id)
                $('#mainThmb').remove();
                $('.errorMessage').remove();

                $("input[name='category_name']").val(editData.category_name);

                var imgElement = $('<img>').attr({
                    'src': "/" + editData.category_icon,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',

                });
                $('#category_icon').after(imgElement);
                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#categoryForm').attr('action',
                    "{{ route('category.update', ['category' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $('.errorMessage').remove();

            $("input[name='category_icon']").val('');
            $("input[name='category_name']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#categoryForm').attr('action', "{{ route('category.store') }}");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>



    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                $('#mainThmb').remove();
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = $('<img>').attr({
                        'src': e.target.result,
                        'alt': '',
                        'id': 'mainThmb'
                    });
                    $('#category_icon').after(imgElement);
                    $('#category_icon').closest('.form-group').find('.errorMessage.text-danger').remove();
                    $('#category_icon').removeClass('danger');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
