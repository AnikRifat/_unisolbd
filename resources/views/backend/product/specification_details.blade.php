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
                                            <th>Category</th>
                                            <th>Specification</th>
                                            <th>name</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($specificationDetails as $item)
                                            <tr>
                                                <td>{{ $item->category->category_name }}</td>
                                                <td>{{ $item->specification->name }}</td>
                                                <td>{{ $item->name }}
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>


                                                <td class="d-flex text-center">
                                                    <a href="#" data-edit="{{ base64_encode($item) }}"
                                                        onclick="btnEdit(this)" class="btn btn-info btn-sm mr-10">
                                                        <i class="fa-solid fa-edit"></i></a>
                                                    @if ($item->status == 1)
                                                        <a href="#" onclick="btnInactive({{ $item->id }})"
                                                            class="btn btn-danger btn-sm" title="">
                                                            <i class="fa fa-arrow-down"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" onclick="btnActive({{ $item->id }})"
                                                            class="btn btn-success btn-sm" title="">
                                                            <i class="fa fa-arrow-up"></i>
                                                        </a>
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
                            <h3 class="box-title">Specification Details</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">


                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <div class="controls">
                                    <select id="category_id" name="category_id" class="form-control form-control-sm">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <label>Specification<span class="text-danger">*</span></label>
                                <div class="controls">
                                    <select id="specification_id" name="specification_id"
                                        class="form-control form-control-sm select2" data-live-search="true">
                                        @foreach ($specifications as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="name">name<span class="text-danger">*</span></label>
                                <input id="name" type="text" name="name" class="form-control form-control-sm">

                            </div>



                            <div class="form-group">
                                <label class="info-title" for="details">Details<span class="text-danger">*</span></label>
                                <textarea id="details" type="text" name="details" class="form-control"></textarea>
                            </div>




                            <div class="form-group">
                                <a id="btnSave" class="btn  btn-sm btn-success">Save</a>
                                <a id="btnClear" onclick="btnClear()" class="btn btn-sm btn-primary">Clear</a>
                            </div>



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
        var id;


        $(document).on("click", "#btnSave", function() {
            let data = {
                "category_id": $("#category_id").val(),
                "specification_id": $("#specification_id").val(),
                "name": $("#name").val(),
                "details": $("#details").val(),
            };
            $.ajax({
                type: "POST",
                url: "{{ route('specification-detail.store') }}",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    btnClear();
                    getData();

                },
                error: function(xhr, textStatus, errorThrown) {
                    requestValidate(xhr);
                }
            });
        });


        function btnEdit(e) {
            var data = $(e).data('edit'); // Get the Base64-encoded JSON data
            var decodedData = atob(data); // Decode the Base64-encoded data
            var jsonObject = JSON.parse(decodedData); // Parse the JSON data
            console.log("Decoded JSON Data: ", jsonObject);
            id=jsonObject.id;

            $("#category_id").val(jsonObject.category_id).change();
            $("#specification_id").val(jsonObject.specification_id).change();
            $("#name").val(jsonObject.name);
            $("#details").val(jsonObject.details);
            $('#btnSave').remove();
             if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<a id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }


        }

        function getData() {

            $.ajax({
                type: "get",
                url: "{{ route('specification-detail.index') }}",
                dataType: "JSON",
                success: function(response) {
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(data) {
                        var row = $("<tr>");
                        var encodedData = btoa(JSON.stringify(data)); // Encode the d
                        row.append(`
                            <td>${data.category.category_name}</td>
                            <td>${data.specification.name}</td>
                            <td>${data.name}</td>
                            <td class="text-center">
                            <span class="badge badge-${data.status == 1 ? 'success' : 'danger'}">
                                ${data.status == 1 ? 'Active' : 'Inactive'}
                            </span>
                            </td>
                            <td class="d-flex text-center">
                                <a data-edit="${encodedData}"
                                 onclick="btnEdit(this)"  class="btn btn-info btn-sm mr-10"><i class="fa-solid fa-edit"></i></a>
                                ${data.status == 1 ?
                                `<a onclick="btnInactive(${data.id })"  class="btn btn-danger btn-sm" title=""><i class="fa fa-arrow-down"></i></a>`
                                :
                                `<a onclick="btnActive(${data.id })"  class="btn btn-success btn-sm" title=""><i class="fa fa-arrow-up"></i></a>`
                                }
                            </td>
                        `);
                        dataTable.row.add(row).draw(false);
                    });

                }
            });
        }


        $(document).on("click", "#btnUpdate", function() {
            let data = {
                "category_id": $("#category_id").val(),
                "specification_id": $("#specification_id").val(),
                "name": $("#name").val(),
                "details": $("#details").val(),
            };

            var updateUrl = "{{ route('specification-detail.update', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);

            $.ajax({
                type: "PUT",
                url: updateUrl,
                data: data,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    btnClear();
                    getData();

                },
                error: function(xhr, textStatus, errorThrown) {
                    requestValidate(xhr);
                }
            });
        });

        function btnClear() {
            $(".errorMessage").remove();
            $("#name").val('');
            $("#details").val('');
            $('#btnUpdate').remove();
            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<a id="btnSave" class="btn btn-sm btn-success mr-1">Save</a>');
            }
        }

        function requestValidate(xhr) {
            $('.errorMessage').remove();
            // Handle the validation errors if they exist in the response
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(fieldName, errorMessages) {
                    var errorMessage = '<span class="text-danger errorMessage">' + errorMessages[0] + '</span>';
                    $('#' + fieldName).after(errorMessage);
                });
            }
        }

        function btnActive(id) {
            console.log(id);

            var updateUrl = "{{ route('active.specification-detail', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);

            $.ajax({
                type: "POST",
                url: updateUrl,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    getData();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function btnInactive(id) {
            console.log(id);
            var updateUrl = "{{ route('inactive.specification-detail', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);
            $.ajax({
                type: "POST",
                url: updateUrl,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    getData();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
