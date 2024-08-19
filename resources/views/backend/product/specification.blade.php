@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Specification List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Specification</th>
                                            <th class="text-center">Filter</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specification as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->filter == 1)
                                                        <span class="badge bade-fills badge-success">On</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Off</span>
                                                    @endif
                                                </td>
                                                <td >
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center " >
                                                    <a data-edit="{{ base64_encode($item) }}" data-toggle="tooltip"
                                                        title="Edit Specification"
                                                        class="btn btn-sm btn-info btnEdit mr-10"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>

                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('inactive.specification', $item->id) }}">
                                                            @csrf

                                                            <button data-toggle="tooltip" title="Inactive Specification"
                                                                class="btn btn-sm btn-danger mr-10"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('active.specification', $item->id) }}">
                                                            @csrf
                                                            <button data-toggle="tooltip" title="Active Specification"
                                                                class="btn btn-sm btn-success mr-10"
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
                            <h3 class="box-title">Add Specification</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="specificationForm" method="POST" action="{{ route('specification.store') }}">
                                @csrf 
                                @method('post') 

                                <div class="form-group">
                                    <label class="info-title" for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="demo-checkbox mt-3">
                                    <input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-success"
                                        name="filter" value="1" />
                                    <label for="md_checkbox_23">Check for product filter</label>
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
                console.log(base64EncodedValue)

                $("input[name='name']").val(editData.name);
                $("#md_checkbox_23").prop("checked", editData.filter == 1 ? true : false);

               
                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#specificationForm').attr('action',
                    "{{ route('specification.update', ['specification' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("#specificationForm input[name='_method']").val('PUT');

            });

            $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='name']").val('');
            $("#md_checkbox_23").prop("checked", false);

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#specificationForm').attr('action', "{{ route('specification.store') }}");

            // Change the method override field value to PUT
            $("#specificationForm input[name='_method']").val('POST');

        });
        });

      
    </script>
@endsection
