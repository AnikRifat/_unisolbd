@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">User List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->userRoles)
                                                        @foreach ($item->userRoles as $roleItem)
                                                            <span class="badge badge-primary">{{ $roleItem->role->name }}</span>
                                                        @endforeach
                                                    @endif

                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                    <a data-edit="{{ base64_encode($item) }}" data-toggle="tooltip"
                                                        title="edit user" class="btn btn-sm btn-info btnEdit mr-10"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('inactive.user', $item->id) }}">
                                                            @csrf

                                                            <button data-toggle="tooltip" title="Inactive Status"
                                                                class="btn btn-sm btn-success mr-10"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{ route('active.user', $item->id) }}">
                                                            @csrf
                                                            <button data-toggle="tooltip" title="Active Status"
                                                                class="btn btn-sm btn-danger mr-10"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @endif
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



                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add User</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="userForm" method="POST" action="{{ route('user-management.store') }}">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <label class="info-title" for="name">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" value="{{ old('name') }}" name="name" class="form-control form-control-sm">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="email">Emai</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-sm">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="code">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control form-control-sm">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="code">Password</label>
                                        <input type="text" id="password" name="password" class="form-control form-control-sm">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="name">Type</label>
                                        <select name="type" id="type" class="form-control" data-placeholder="Select Type">
                                            <option value="" selected disabled>Choose Type</option>
                                            @foreach (['Super Admin', 'Employee', 'Admin', 'Normal User'] as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="roles[]" class="form-control select2" multiple="multiple"
                                            data-placeholder="Select Role" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach


                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
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

                $("#name").val(editData.name);
                $("#email").val(editData.email);
                $("#phone").val(editData.phone);
                $("#password").val(editData.password);
                $("#type").val(editData.type).change();

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#userForm').attr('action', "{{ route('user-management.update', ['user_management' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("#name").val("");
            $("#email").val("");
            $("#phone").val("");
            $("#password").val("");


            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#userForm').attr('action', "{{ route('user-management.store') }}");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>
@endsection
