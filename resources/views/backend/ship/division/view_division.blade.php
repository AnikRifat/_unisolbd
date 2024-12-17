@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Division List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($divisions as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>

                                                <td class="w-20 text-center">
                                                    <a data-division="{{ $item }}" class="editDivision">
                                                        <i class="fa-solid fa-edit text-primary m-2"></i>
                                                    </a>
                                                    <a id="deleteButton" data-division="{{ $item->id }}">
                                                        <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                                                    </a>
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
                            <h3 class="box-title">Add Division</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="devisionForm" method="POST" action="{{ route('division.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="info-title">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="actionDiv">
                                        <button type="submit" id="btnSave" class="btn btn-sm btn-success">Save</button>
                                        <a href="javascript:void(0)" id="btnClear" class="btn btn-sm btn-primary">Clear</a>
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
            $('.editDivision').click(function() {
                var divisionData = $(this).data('division');
                $("input[name='name']").val(divisionData.name);
                $('#btnSave').remove();
                // Append the "Update" button before the existing "Clear" button

                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }

                // Set the form action dynamically
                $('#devisionForm').attr('action', "{{ route('division.update', ['id' => ':id']) }}".replace(
                    ':id', divisionData.id));

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $("input[name='name']").val("");
            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#devisionForm').attr('action', "{{ route('division.store') }}");

        });
    </script>


    <script>
        $(document).ready(function() {
            $('#deleteButton').click(function() {
                var divisionId = $(this).data('division');

                // Display a confirmation alert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, redirect to the delete route
                        window.location.href = "{{ route('division.delete', ['id' => ':id']) }}"
                            .replace(':id', divisionId);
                    }
                });
            });
        });
    </script>
@endsection
