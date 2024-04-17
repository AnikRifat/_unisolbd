@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">State List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Division Name</th>
                                            <th>District Name</th>
                                            <th>State Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $state)
                                            <tr>
                                                <td>{{ $state['division']['name'] }}</td>
                                                <td>{{ $state['district']['name'] }}</td>
                                                <td>{{ $state->name }}</td>
                                                <td class="w-20 text-center">
                                                    <a data-state="{{ $state }}" class="editState">
                                                        <i class="fa-solid fa-edit text-primary m-2"></i>
                                                    </a>
                                                    <a id="deleteButton" data-state="{{ $state->id }}">
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



                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Select Division<span class="text-danger">*</span></label>
                                <div class="controls">
                                    <select onchange="getDistrict()" id="division_id" name="division_id"
                                        class="form-control select2">
                                        <option selected="true" disabled="disabled">Select Division
                                        </option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger error-message "></span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Select District<span class="text-danger">*</span></label>
                                <div class="controls">
                                    <select id="district_id" name="district_id" class="form-control select2">
                                        <option selected="true" disabled="disabled">Select District</option>
                                    </select>

                                    <span class="text-danger error-message"></span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="info-title">Name<span class="text-danger">*</span></label>
                                <input id="name" type="text" name="name" class="form-control form-control-sm"
                                    value="{{ old('name') }}">

                                <span class="text-danger error-message"></span>

                            </div>
                            <div class="form-group" id="actionDiv">
                                <button onclick="storeState()" id="btnSave" class="btn btn-sm btn-success">Save</button>
                                <a href="javascript:void(0)" id="btnClear" onclick="Clear()"
                                    class="btn btn-sm btn-primary">Clear</a>
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
        function getDistrict() {
            var selectedValue = $("select[name='division_id']").val();
            console.log(selectedValue);

            // Generate the URL using Laravel's route() function
            // Generate the URL using Laravel's route() function
            var url = "{{ route('get-district', ['id' => ':id']) }}";
            url = url.replace(':id', selectedValue);

            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('select[name="district_id"]').empty();
                    $.each(response, function(key, value) {
                        $('select[name="district_id"]').append(
                            '<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });

        }
    </script>

    <script>
        $(document).ready(function () {
            
        });
        function storeState() {
            let obj = {
                division_id: $('#division_id').val(),
                district_id: $('#district_id').val(),
                name: $('#name').val()
            }

            $.ajax({
                type: "POST",
                url: "{{ route('state.store') }}",
                data: obj,
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $('.error-message').empty(); // Clear error messages with the 'error-message' class
                    getStateData();
                    showToastr(response.type, response.message);
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;

                        console.log(errors)
                        console.log(errors.name[0])
                        // Clear error messages with the 'error-message' class
                        $('.error-message').empty();

                        // Display the validation errors
                        if (errors.division_id) {
                            $('#division_id').parent().find('.error-message').text(errors.division_id[0]);
                        }
                        if (errors.district_id) {
                            $('#district_id').parent().find('.error-message').text(errors.district_id[0]);
                        }
                        if (errors.name) {
                            $('#name').parent().find('.error-message').text(errors.name[0]);
                        }
                    }
                    // Handle the case of error if needed
                }
            });

        }

        function getStateData() {

            $.ajax({
                type: "get",
                url: "{{ route('get-state') }}",
                dataType: "JSON",
                success: function(response) {
                    console.log(response)
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(state) {
                        var row = $("<tr>");
                        row.append(`
                        <td>${state.division.name}</td>
                        <td>${state.district.name}</td>
                        <td>${state.name }</td>
                        <td class="w-20 text-center">
                            <a data-state="${state}" class="editState">
                                <i class="fa-solid fa-edit text-primary m-2"></i>
                            </a>
                            <a id="deleteButton" data-state="${state.id }">
                                <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                            </a>
                        </td>
                  
              `);
                        dataTable.row.add(row).draw(false);
                    });

                }
            });
        }

        $('.editState').click(function() {
            var stateData = $(this).data('state');
            updateId = stateData.id;
            $("#name").val(stateData.name);

            $("#division_id").val(stateData.division_id);
            // Trigger the change event after setting the division_id value
            $("#division_id").trigger('change');
            // Wait for a small delay before changing the district_id value
            setTimeout(function() {
                $("#district_id").val(stateData.district_id).change();
            }, 1000);

            $('#btnSave').remove();
            $('#btnUpdate').remove();

            console.log(stateData);

            var encodedUpdateId = encodeURIComponent(updateId);
            $('#btnClear').before(
                '<button type="submit" data-state="' + encodedUpdateId +
                '" id="btnUpdate" onclick="updateState()" class="btn btn-sm btn-success mr-1">Update</button>'
            );


        });


        function Clear() {
            $('#btnUpdate').remove();
            $("#name").val("");
            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '  <button onclick="storeState()" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>'
                );
            }
        }





        function updateState() {
            var encodedUpdateId = $('#btnUpdate').data('state');
            var updateId = decodeURIComponent(encodedUpdateId);
            let obj = {
                id: updateId,
                division_id: $('#division_id').val(),
                district_id: $('#district_id').val(),
                name: $('#name').val()
            }

            $.ajax({
                type: "POST",
                url: "{{ route('state.update') }}",
                data: obj,
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $('.error-message').empty(); // Clear error messages with the 'error-message' class
                    getStateData();
                    showToastr(response.type, response.message);
                    Clear();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;

                        console.log(errors)
                        console.log(errors.name[0])
                        // Clear error messages with the 'error-message' class
                        $('.error-message').empty();

                        // Display the validation errors
                        if (errors.division_id) {
                            $('#division_id').parent().find('.error-message').text(errors.division_id[0]);
                        }
                        if (errors.district_id) {
                            $('#district_id').parent().find('.error-message').text(errors.district_id[0]);
                        }
                        if (errors.name) {
                            $('#name').parent().find('.error-message').text(errors.name[0]);
                        }
                    }
                    // Handle the case of error if needed
                }
            });

        }


     
            $('#deleteButton').click(function() {
                var stateId = $(this).data('state');

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
                        // window.location.href = "{{ route('division.delete', ['id' => ':id']) }}"
                        //     .replace(':id', divisionId);

                        $.ajax({
                            type: "post",
                            url: "{{ route('state.delete') }}",
                            data: {
                                id: stateId
                            },
                            dataType: "json",
                            success: function(response) {
                                getStateData();
                                showToastr(response.type, response.message);
                            }
                        });
                    }
                });
            });
      
    </script>
@endsection
