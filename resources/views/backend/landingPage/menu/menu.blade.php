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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Menu List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="display:none;"></th>
                                            <th>Name</th>
                                            <th class="text-center">status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $item)
                                            <tr>
                                                <td style="display:none;">{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>

                                                <td class="text-center">
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                    <a data-edit-menu="{{ base64_encode($item) }}"
                                                        class="btn btn-sm btn-info editMenu mr-10" href="javascript:void(0)"
                                                        ><i class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                    <form method="POST" action="{{ route('inactive.menu',$item->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-down"></i></button>
                                                    </form>
                                                    @else
                                                    <form method="POST" action="{{ route('active.menu',$item->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-up"></i></button>
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



                <div class="col-lg-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Menu</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="menuForm" method="POST" action="{{ route('menu.store') }}">
                                @csrf
                                @method('POST')


                                <div class="form-group">
                                    <label class="info-title">Name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">Link</label>
                                    <textarea type="text" id="link" name="link" class="form-control form-control-sm"> </textarea>
                                </div>

                                <div class="form-group">
                                    <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                    <a id="btnClear"  class="btn  btn-sm btn-primary">Clear</a>
                                </div>

                            </form>


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
            $('.editMenu').click(function() {
                var base64EncodedValue = $(this).data('edit-menu');
                var menuData = JSON.parse(atob(base64EncodedValue));

                console.log(menuData.id)

                $("input[name='name']").val(menuData.name);
                $("input[name='link']").val(menuData.link);

                $('#btnSave').remove();

                console.log(menuData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#menuForm').attr('action', "{{ route('menu.update', ['menu' => ':id']) }}"
                    .replace(
                        ':id', menuData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='name']").val('');
            $("textarea[name='link']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#menuForm').attr('action', "{{ route('menu.store') }}");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>
@endsection
