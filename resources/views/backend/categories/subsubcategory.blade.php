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

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sub-subcategory List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Sub-subcategory</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Subsubcategories as $item)
                                            <tr>
                                                <td>{{ $item->category->category_name }}</td>
                                                <td>{{ $item->subcategory->subcategory_name }}</td>
                                                <td>{{ $item->subsubcategory_name }}</td>
                                                <td class="text-center">
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
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

                <div class="col-lg-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Subcategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="form-group">
                                <label class="info-title" for="category_id">Category<span
                                        class="text-danger">*</span></label>
                                <div class="controls">
                                    <select id="category_id" name="category_id"
                                        class="form-control form-control-sm select2">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="category_id">Subcategory<span
                                        class="text-danger">*</span></label>
                                <div class="controls">
                                    <select id="subcategory_id" name="subcategory_id"
                                        class="form-control form-control-sm select2">
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="subcategory_name">Sub-subcategory Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="subsubcategory_name" name="subsubcategory_name"
                                    class="form-control form-control-sm">
                                <span class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <a id="btnSave" class="btn  btn-sm btn-success">Save</a>
                                <a id="btnClear" onclick="btnClear()" class="btn btn-sm btn-primary">Clear</a>
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
                "subcategory_id": $("#subcategory_id").val(),
                "subsubcategory_name": $("#subsubcategory_name").val().trim(),
            };
            $.ajax({
                type: "POST",
                url: "{{ route('subsubcategory.store') }}",
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
            $("#subcategory_id").val(jsonObject.subcategory_id).change();
            $("#subsubcategory_name").val(jsonObject.subsubcategory_name);
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
                url: "{{ route('subsubcategory.index') }}",
                dataType: "JSON",
                success: function(response) {
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(data) {
                        var row = $("<tr>");
                        var encodedData = btoa(JSON.stringify(data)); // Encode the d
                        row.append(`
                            <td>${data.category.category_name}</td>
                            <td>${data.subcategory.subcategory_name}</td>
                            <td>${data.subsubcategory_name}</td>
                            <td class="text-center">
                            <span class="badge badge-${data.status == 1 ? 'success' : 'danger'}">
                                ${data.status == 1 ? 'Active' : 'Inactive'}
                            </span>
                            </td>
                            <td class="text-center">
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
                "subcategory_id": $("#subcategory_id").val(),
                "subsubcategory_name": $("#subsubcategory_name").val().trim(),
            };

            var updateUrl = "{{ route('subsubcategory.update', ':id') }}";
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
            $("#subsubcategory_name").val('');
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

            var updateUrl = "{{ route('active.subsubcategory', ':id') }}";
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
            var updateUrl = "{{ route('inactive.subsubcategory', ':id') }}";
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


    <script>
        var category_id = $('#category_id');
        var subcategorySelect = $('#subcategory_id');
        var subcategories = {!! $subcategories !!}


        $(document).ready(function() {
            loadSubcategory();
            $(document).on("change", "#category_id", function() {
                loadSubcategory();
            });
        });



        function loadSubcategory() {
            subcategorySelect.empty();
            $.each(subcategories, function(index, subcategory) {
                if (subcategory.category_id == category_id.val()) {
                    subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory
                        .subcategory_name + '</option>');
                }
            });
        }
    </script>
@endsection
